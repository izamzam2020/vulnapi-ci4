<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Base Controller
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon class instantiation.
     *
     * @var list<string>
     */
    protected $helpers = ['jwt'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
    }

    /**
     * Get current authenticated user from JWT
     */
    protected function getAuthUser(): ?object
    {
        return $this->request->user ?? null;
    }

    /**
     * Check if current user is admin
     */
    protected function isAdmin(): bool
    {
        $user = $this->getAuthUser();
        return $user && isset($user->role) && $user->role === 'admin';
    }

    /**
     * Return JSON success response
     */
    protected function success($data, int $code = 200): ResponseInterface
    {
        return $this->response
            ->setStatusCode($code)
            ->setJSON([
                'status' => 'success',
                'data'   => $data
            ]);
    }

    /**
     * Return JSON error response
     */
    protected function error(string $message, int $code = 400, ?string $errorCode = null): ResponseInterface
    {
        $response = [
            'status'  => 'error',
            'message' => $message
        ];

        if ($errorCode) {
            $response['code'] = $errorCode;
        }

        return $this->response
            ->setStatusCode($code)
            ->setJSON($response);
    }
}

