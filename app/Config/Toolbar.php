<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Debug\Toolbar\Collectors\Database;
use CodeIgniter\Debug\Toolbar\Collectors\Events;
use CodeIgniter\Debug\Toolbar\Collectors\Files;
use CodeIgniter\Debug\Toolbar\Collectors\Logs;
use CodeIgniter\Debug\Toolbar\Collectors\Routes;
use CodeIgniter\Debug\Toolbar\Collectors\Timers;
use CodeIgniter\Debug\Toolbar\Collectors\Views;

/**
 * Debug Toolbar Configuration
 */
class Toolbar extends BaseConfig
{
    /**
     * Collectors
     */
    public array $collectors = [
        Timers::class,
        Database::class,
        Logs::class,
        Views::class,
        Files::class,
        Routes::class,
        Events::class,
    ];

    /**
     * Collect Var Data
     */
    public bool $collectVarData = true;

    /**
     * Max History
     */
    public int $maxHistory = 20;

    /**
     * View Path
     */
    public string $viewsPath = SYSTEMPATH . 'Debug/Toolbar/Views/';

    /**
     * Max Queries
     */
    public int $maxQueries = 100;

    /**
     * Watched Directories
     */
    public array $watchedDirectories = [
        'app',
    ];

    /**
     * Watched Extensions
     */
    public array $watchedExtensions = [
        'php',
        'html',
        'css',
        'js',
    ];
}

