<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Images\Handlers\GDHandler;
use CodeIgniter\Images\Handlers\ImageMagickHandler;

/**
 * Images Configuration
 */
class Images extends BaseConfig
{
    /**
     * Default Handler
     */
    public string $defaultHandler = 'gd';

    /**
     * Library Path for ImageMagick
     */
    public string $libraryPath = '/usr/local/bin/convert';

    /**
     * Available handlers
     */
    public array $handlers = [
        'gd'      => GDHandler::class,
        'imagick' => ImageMagickHandler::class,
    ];
}

