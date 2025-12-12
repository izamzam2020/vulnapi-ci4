<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use Config\Database;

/**
 * Debug Controller
 * 
 * VULNERABILITIES:
 * - Weak token protection (simple string comparison)
 * - Info disclosure via /debug/info endpoint
 * - Database reset functionality exposed
 */
class DebugController extends BaseController
{
    /**
     * POST /api/debug/reset
     * 
     * Reset and reseed the database
     * 
     * VULNERABILITY: Uses weak static token for protection
     * Token is easily guessable or brute-forceable
     */
    public function resetDatabase()
    {
        // Check if this is a browser form request or API request
        $acceptsHtml = strpos($this->request->getHeaderLine('Accept'), 'text/html') !== false;
        
        try {
            // Try to get token from multiple sources
            $token = $this->request->getPost('token') 
                  ?? $this->request->getGet('token') 
                  ?? '';
            
            // Also try JSON body
            if (empty($token)) {
                $body = $this->request->getBody();
                if (!empty($body)) {
                    $decoded = json_decode($body, true);
                    if (json_last_error() === JSON_ERROR_NONE && isset($decoded['token'])) {
                        $token = $decoded['token'];
                    }
                }
            }

            $expectedToken = getenv('RESET_TOKEN') ?: 'reset123';

            if ($token !== $expectedToken) {
                if ($acceptsHtml) {
                    return redirect()->to('/')->with('error', 'Invalid reset token');
                }
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid reset token'
                ])->setStatusCode(401);
            }

            // Run migrations refresh
            $migrate = \Config\Services::migrations();
            $migrate->setNamespace('App');
            $migrate->regress(0);
            $migrate->latest();
            
            // Run seeder
            $seeder = Database::seeder();
            $seeder->call('VulnApiSeeder');

            if ($acceptsHtml) {
                // Redirect back to home page with success message
                return redirect()->to('/?reset=success');
            }

            return $this->response->setJSON([
                'status' => 'success',
                'data' => [
                    'message' => 'Database reset and reseeded successfully',
                    'timestamp' => date('Y-m-d H:i:s')
                ]
            ]);

        } catch (\Throwable $e) {
            if ($acceptsHtml) {
                return redirect()->to('/?reset=error&msg=' . urlencode($e->getMessage()));
            }
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Database reset failed: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    /**
     * GET /api/debug/info
     * 
     * VULNERABILITY: Exposes system information without authentication
     * Information disclosure vulnerability
     */
    public function info()
    {
        // VULNERABILITY: No authentication - completely public
        // Exposes sensitive system information

        $info = [
            'app' => [
                'name'        => 'VulnAPI',
                'version'     => '1.0.0',
                'environment' => getenv('CI_ENVIRONMENT') ?: 'production',
                'base_url'    => base_url(),
            ],
            'php' => [
                'version'    => phpversion(),
                'sapi'       => php_sapi_name(),
                'extensions' => get_loaded_extensions(),
            ],
            'server' => [
                'software'   => $_SERVER['SERVER_SOFTWARE'] ?? 'unknown',
                'os'         => PHP_OS,
                'hostname'   => gethostname(),
                'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? 'unknown',
            ],
            'database' => [
                'driver'   => getenv('database.default.DBDriver') ?: 'MySQLi',
                'host'     => getenv('database.default.hostname') ?: 'db',
                'database' => getenv('database.default.database') ?: 'vulnapi',
                'port'     => getenv('database.default.port') ?: '3306',
            ],
            'jwt' => [
                // VULNERABILITY: Exposing JWT configuration!
                'algorithm' => getenv('JWT_ALGO') ?: 'HS256',
                'expiry'    => getenv('JWT_EXPIRY') ?: '3600',
                // Don't expose secret, but hint at its weakness
                'secret_length' => strlen(getenv('JWT_SECRET') ?: 'secret'),
            ],
            'paths' => [
                'app'      => APPPATH,
                'writable' => WRITEPATH,
                'uploads'  => FCPATH . 'uploads',
            ],
            'memory' => [
                'usage'     => round(memory_get_usage(true) / 1024 / 1024, 2) . ' MB',
                'peak'      => round(memory_get_peak_usage(true) / 1024 / 1024, 2) . ' MB',
                'limit'     => ini_get('memory_limit'),
            ],
            'timestamp' => date('Y-m-d H:i:s'),
        ];

        return $this->success(['info' => $info]);
    }
}

