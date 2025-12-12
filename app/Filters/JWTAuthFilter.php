<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * JWT Authentication Filter
 * 
 * VULNERABILITY NOTES:
 * - This filter is NOT applied globally
 * - Must be explicitly added to routes
 * - No role-based authorization (just authentication)
 * - User data attached to request without validation
 */
class JWTAuthFilter implements FilterInterface
{
    /**
     * Check JWT token before request processing
     *
     * @param RequestInterface $request
     * @param array|null $arguments
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('jwt');

        $token = get_jwt_from_header();

        if (!$token) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'No authorization token provided',
                    'code'    => 'AUTH_TOKEN_MISSING'
                ]);
        }

        $decoded = decode_jwt($token);

        if (!$decoded) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Invalid or expired token',
                    'code'    => 'AUTH_TOKEN_INVALID'
                ]);
        }

        // VULNERABILITY: Blindly trust JWT claims without database verification
        // In a secure app, you'd verify the user still exists, isn't banned, etc.
        $request->user = $decoded;

        return $request;
    }

    /**
     * Post-processing (not used)
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do after
    }
}

