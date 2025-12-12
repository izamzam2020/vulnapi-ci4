<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Log\Handlers\FileHandler;

/**
 * Logger Configuration
 */
class Logger extends BaseConfig
{
    /**
     * Log threshold
     */
    public int $threshold = 4; // Log everything

    /**
     * Date format
     */
    public string $dateFormat = 'Y-m-d H:i:s';

    /**
     * Log handlers
     */
    public array $handlers = [
        FileHandler::class => [
            'handles'         => ['critical', 'alert', 'emergency', 'debug', 'error', 'info', 'notice', 'warning'],
            'fileExtension'   => 'log',
            'filePermissions' => 0644,
            'path'            => '',
        ],
    ];
}

