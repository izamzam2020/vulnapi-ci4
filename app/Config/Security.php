<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Security Configuration
 * 
 * VULNERABILITY: CSRF and other protections intentionally disabled
 */
class Security extends BaseConfig
{
    /**
     * CSRF Protection Method
     */
    public string $csrfProtection = 'cookie';

    /**
     * Randomize CSRF Token
     */
    public bool $tokenRandomize = false;

    /**
     * CSRF Token Name
     */
    public string $tokenName = 'csrf_token';

    /**
     * CSRF Header Name
     */
    public string $headerName = 'X-CSRF-TOKEN';

    /**
     * CSRF Cookie Name
     */
    public string $cookieName = 'csrf_cookie';

    /**
     * CSRF Expires
     */
    public int $expires = 7200;

    /**
     * Regenerate CSRF Token
     */
    public bool $regenerate = false;

    /**
     * Redirect on CSRF failure
     */
    public bool $redirect = false;

    /**
     * CSRF SameSite
     */
    public string $samesite = 'Lax';
}

