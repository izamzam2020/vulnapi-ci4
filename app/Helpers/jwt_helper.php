<?php

/**
 * VulnAPI JWT Helper
 * 
 * VULNERABILITIES:
 * - Uses weak secret ("secret") from env
 * - No token blacklisting
 * - No refresh token mechanism
 * - Expiration not strictly enforced
 */

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if (!function_exists('generate_jwt')) {
    /**
     * Generate a JWT token
     * 
     * @param array $payload Token payload (user data)
     * @return string JWT token
     */
    function generate_jwt(array $payload): string
    {
        $secret = getenv('JWT_SECRET') ?: 'secret'; // VULNERABILITY: Weak default secret
        $algo = getenv('JWT_ALGO') ?: 'HS256';
        $expiry = (int)(getenv('JWT_EXPIRY') ?: 3600);

        $issuedAt = time();
        $expirationTime = $issuedAt + $expiry;

        $tokenPayload = array_merge($payload, [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'iss' => 'vulnapi',
        ]);

        return JWT::encode($tokenPayload, $secret, $algo);
    }
}

if (!function_exists('decode_jwt')) {
    /**
     * Decode and validate a JWT token
     * 
     * VULNERABILITY: Catches all exceptions loosely, may leak info
     * 
     * @param string $token JWT token
     * @return object|null Decoded payload or null on failure
     */
    function decode_jwt(string $token): ?object
    {
        try {
            $secret = getenv('JWT_SECRET') ?: 'secret';
            $algo = getenv('JWT_ALGO') ?: 'HS256';

            $decoded = JWT::decode($token, new Key($secret, $algo));
            
            return $decoded;
        } catch (\Firebase\JWT\ExpiredException $e) {
            // VULNERABILITY: Token expiration is logged but we could still process
            log_message('warning', 'JWT expired: ' . $e->getMessage());
            return null;
        } catch (\Firebase\JWT\SignatureInvalidException $e) {
            log_message('warning', 'JWT signature invalid: ' . $e->getMessage());
            return null;
        } catch (\Exception $e) {
            // VULNERABILITY: Generic error handling, could leak info in logs
            log_message('error', 'JWT decode error: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('get_jwt_from_header')) {
    /**
     * Extract JWT token from Authorization header
     * 
     * @return string|null Token or null if not found
     */
    function get_jwt_from_header(): ?string
    {
        $request = service('request');
        $authHeader = $request->getHeaderLine('Authorization');

        if (empty($authHeader)) {
            return null;
        }

        // Check for Bearer token
        if (preg_match('/Bearer\s+(.+)$/i', $authHeader, $matches)) {
            return $matches[1];
        }

        return null;
    }
}

if (!function_exists('validate_jwt')) {
    /**
     * Validate JWT and return user data
     * 
     * @return array|null User data or null if invalid
     */
    function validate_jwt(): ?array
    {
        $token = get_jwt_from_header();
        
        if (!$token) {
            return null;
        }

        $decoded = decode_jwt($token);
        
        if (!$decoded) {
            return null;
        }

        return (array) $decoded;
    }
}

