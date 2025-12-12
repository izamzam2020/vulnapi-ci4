<?php

namespace Config;

use CodeIgniter\Config\Routing as BaseRouting;

/**
 * Routing Configuration
 */
class Routing extends BaseRouting
{
    /**
     * Default namespace for controllers
     */
    public string $defaultNamespace = 'App\Controllers';

    /**
     * Default controller
     */
    public string $defaultController = 'Home';

    /**
     * Default method
     */
    public string $defaultMethod = 'index';

    /**
     * Translate dashes in URIs
     */
    public bool $translateURIDashes = false;

    /**
     * Auto route
     */
    public bool $autoRoute = false;

    /**
     * Priority routes
     */
    public bool $prioritize = false;

    /**
     * Route files
     */
    public array $routeFiles = [
        APPPATH . 'Config/Routes.php',
    ];

    /**
     * Module routes
     */
    public array $moduleRoutes = [];
}

