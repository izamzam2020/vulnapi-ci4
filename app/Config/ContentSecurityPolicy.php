<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Content Security Policy Configuration
 * 
 * VULNERABILITY: CSP is disabled
 */
class ContentSecurityPolicy extends BaseConfig
{
    /**
     * Report Only mode
     */
    public bool $reportOnly = false;

    /**
     * Report URI
     */
    public ?string $reportURI = null;

    /**
     * Upgrade Insecure Requests
     */
    public bool $upgradeInsecureRequests = false;

    // Default sources - permissive
    public $defaultSrc = "'self'";
    public $scriptSrc = "'self' 'unsafe-inline' 'unsafe-eval'";
    public $styleSrc = "'self' 'unsafe-inline'";
    public $imageSrc = "'self' data:";
    public $baseURI = null;
    public $childSrc = "'self'";
    public $connectSrc = "'self'";
    public $fontSrc = "'self'";
    public $formAction = "'self'";
    public $frameAncestors = null;
    public $frameSrc = null;
    public $mediaSrc = null;
    public $objectSrc = "'self'";
    public $pluginTypes = null;
    public $sandbox = null;
}

