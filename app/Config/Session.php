<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\FileHandler;

/**
 * Session Configuration
 */
class Session extends BaseConfig
{
    /**
     * Session Driver
     */
    public string $driver = FileHandler::class;

    /**
     * Session Cookie Name
     */
    public string $cookieName = 'ci_session';

    /**
     * Session Expiration
     */
    public int $expiration = 7200;

    /**
     * Session Save Path
     */
    public string $savePath = WRITEPATH . 'session';

    /**
     * Match IP
     */
    public bool $matchIP = false;

    /**
     * Time to Update
     */
    public int $timeToUpdate = 300;

    /**
     * Regenerate Destroy
     */
    public bool $regenerateDestroy = false;

    /**
     * Cookie Domain
     */
    public string $cookieDomain = '';

    /**
     * Cookie Path
     */
    public string $cookiePath = '/';

    /**
     * Cookie Secure
     */
    public bool $cookieSecure = false;

    /**
     * Cookie SameSite
     */
    public string $cookieSameSite = 'Lax';
}

