<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Migrations Configuration
 */
class Migrations extends BaseConfig
{
    /**
     * Enable migrations
     */
    public bool $enabled = true;

    /**
     * Migration table name
     */
    public string $table = 'migrations';

    /**
     * Timestamp format
     */
    public string $timestampFormat = 'Y-m-d-His_';
}

