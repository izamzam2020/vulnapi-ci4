<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use DateTimeInterface;

/**
 * Cookie Configuration
 */
class Cookie extends BaseConfig
{
    /**
     * Cookie prefix
     */
    public string $prefix = '';

    /**
     * Cookie expiry
     */
    public DateTimeInterface|int|string $expires = 0;

    /**
     * Cookie path
     */
    public string $path = '/';

    /**
     * Cookie domain
     */
    public string $domain = '';

    /**
     * Cookie secure flag
     */
    public bool $secure = false;

    /**
     * Cookie httponly flag
     */
    public bool $httponly = true;

    /**
     * Cookie samesite
     */
    public string $samesite = 'Lax';

    /**
     * Raw cookie
     */
    public bool $raw = false;
}

