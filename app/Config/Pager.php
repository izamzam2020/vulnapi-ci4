<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Pager Configuration
 */
class Pager extends BaseConfig
{
    /**
     * Templates
     */
    public array $templates = [
        'default_full'   => 'CodeIgniter\Pager\Views\default_full',
        'default_simple' => 'CodeIgniter\Pager\Views\default_simple',
        'default_head'   => 'CodeIgniter\Pager\Views\default_head',
    ];

    /**
     * Per page
     */
    public int $perPage = 20;
}

