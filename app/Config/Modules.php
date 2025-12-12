<?php

namespace Config;

use CodeIgniter\Modules\Modules as BaseModules;

/**
 * Modules Configuration
 */
class Modules extends BaseModules
{
    /**
     * Enable auto-discovery
     */
    public $enabled = true;

    /**
     * Auto-discovery within composer packages
     */
    public $discoverInComposer = true;

    /**
     * Composer packages to scan for auto-discovery
     */
    public array $composerPackages = [];

    /**
     * Aliases for module classes
     */
    public $aliases = [];
}
