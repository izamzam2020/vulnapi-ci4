<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Format\FormatterInterface;
use CodeIgniter\Format\JSONFormatter;
use CodeIgniter\Format\XMLFormatter;

/**
 * Format Configuration
 */
class Format extends BaseConfig
{
    /**
     * Available formatters
     */
    public array $formatters = [
        'application/json' => JSONFormatter::class,
        'application/xml'  => XMLFormatter::class,
        'text/xml'         => XMLFormatter::class,
    ];

    /**
     * Mime types for each format type
     */
    public array $supportedResponseFormats = [
        'application/json',
        'application/xml',
        'text/xml',
        'text/html',
    ];
}

