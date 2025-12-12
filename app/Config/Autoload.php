<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

/**
 * Autoload Configuration
 */
class Autoload extends AutoloadConfig
{
    /**
     * PSR-4 Autoload Map
     */
    public $psr4 = [
        APP_NAMESPACE => APPPATH,
    ];

    /**
     * Class Map Autoload
     */
    public $classmap = [];

    /**
     * Files to load on each request
     */
    public $files = [];

    /**
     * Helpers to load on each request
     */
    public $helpers = ['jwt'];
}

