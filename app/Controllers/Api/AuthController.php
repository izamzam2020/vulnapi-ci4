<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;

/**
 * Authentication Controller
 * 
 * VULNERABILITIES:
 * - Uses weak JWT secret
 * - No rate limiting on login
 * - No account lockout
 * - Verbose error messages reveal user existence
 */
class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * POST /api/auth/login
     * 
     * Authenticate user and return JWT token
     */
    public function login()
    {
        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->error('Invalid JSON payload', 400);
        }

        $email = $json['email'] ?? '';
        $password = $json['password'] ?? '';

        if (empty($email) || empty($password)) {
            return $this->error('Email and password are required', 400);
        }

        // Find user by email
        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            // VULNERABILITY: Reveals that user doesn't exist
            return $this->error('User not found with email: ' . $email, 401, 'USER_NOT_FOUND');
        }

        // Verify password
        if (!$this->userModel->verifyPassword($password, $user['password_hash'])) {
            // VULNERABILITY: Reveals that password is wrong (user exists)
            return $this->error('Invalid password', 401, 'INVALID_PASSWORD');
        }

        // Generate JWT token
        helper('jwt');
        
        $payload = [
            'user_id' => $user['id'],
            'email'   => $user['email'],
            'role'    => $user['role'],
            'org_id'  => $user['org_id'],
        ];

        $token = generate_jwt($payload);

        return $this->success([
            'token'   => $token,
            'user'    => [
                'id'     => $user['id'],
                'email'  => $user['email'],
                'role'   => $user['role'],
                'org_id' => $user['org_id'],
            ],
            'message' => 'Login successful'
        ]);
    }

    /**
     * POST /api/auth/register
     * 
     * Register a new user
     * 
     * VULNERABILITY: No email verification, allows role escalation via mass assignment
     */
    public function register()
    {
        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->error('Invalid JSON payload', 400);
        }

        $email = $json['email'] ?? '';
        $password = $json['password'] ?? '';
        $orgId = $json['org_id'] ?? 1;
        
        // VULNERABILITY: Role can be set by client!
        $role = $json['role'] ?? 'user';

        if (empty($email) || empty($password)) {
            return $this->error('Email and password are required', 400);
        }

        // Check if user exists
        $existingUser = $this->userModel->findByEmail($email);
        if ($existingUser) {
            return $this->error('Email already registered', 409);
        }

        // Create user - VULNERABILITY: role from user input
        $userData = [
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'org_id'        => $orgId,
            'role'          => $role, // VULNERABILITY!
        ];

        $userId = $this->userModel->insert($userData);

        if (!$userId) {
            return $this->error('Failed to create user', 500);
        }

        // Generate token for new user
        helper('jwt');
        
        $payload = [
            'user_id' => $userId,
            'email'   => $email,
            'role'    => $role,
            'org_id'  => $orgId,
        ];

        $token = generate_jwt($payload);

        return $this->success([
            'token'   => $token,
            'user'    => [
                'id'     => $userId,
                'email'  => $email,
                'role'   => $role,
                'org_id' => $orgId,
            ],
            'message' => 'Registration successful'
        ], 201);
    }
}

