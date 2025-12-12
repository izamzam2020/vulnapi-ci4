<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * CORS Configuration
 * 
 * VULNERABILITY: Completely permissive CORS - allows any origin
 */
class Cors extends BaseConfig
{
    /**
     * Default CORS configuration
     */
    public array $default = [
        'allowedOrigins'         => ['*'],
        'allowedOriginsPatterns' => [],
        'supportsCredentials'    => false,
        'allowedHeaders'         => ['*'],
        'exposedHeaders'         => [],
        'allowedMethods'         => ['*'],
        'maxAge'                 => 7200,
    ];
}

