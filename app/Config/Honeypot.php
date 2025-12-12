<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Honeypot Configuration
 */
class Honeypot extends BaseConfig
{
    /**
     * Hidden status
     */
    public bool $hidden = true;

    /**
     * Label
     */
    public string $label = 'Fill This Field';

    /**
     * Name
     */
    public string $name = 'honeypot';

    /**
     * Template
     */
    public string $template = '<label>{label}</label><input type="text" name="{name}" value="">';

    /**
     * Container
     */
    public string $container = '<div style="display:none">{template}</div>';
}

