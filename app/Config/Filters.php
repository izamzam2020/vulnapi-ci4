<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

/**
 * Filters Configuration
 * 
 * VULNERABILITY: CSRF is disabled, JWT filter is not applied globally
 */
class Filters extends BaseFilters
{
    /**
     * Configures aliases for Filter classes to make reading things nicer.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'jwt'           => \App\Filters\JWTAuthFilter::class,
    ];

    /**
     * List of special required filters.
     * 
     * The key is the alias, the value is 'before' or 'after'.
     */
    public array $required = [
        'before' => [
            // 'forcehttps', // Disabled for VulnAPI
        ],
        'after' => [
            // 'toolbar', // Disabled for API
        ],
    ];

    /**
     * List of filter aliases that are always applied before and after every request.
     * VULNERABILITY: JWT filter is NOT applied globally - must be specified per route
     */
    public array $globals = [
        'before' => [
            // 'csrf', // VULNERABILITY: CSRF disabled for API
            // 'jwt',  // VULNERABILITY: JWT not applied globally
        ],
        'after' => [
            // 'secureheaders', // VULNERABILITY: Secure headers disabled
        ],
    ];

    /**
     * List of filter aliases that works on a particular HTTP method.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any before or after URI patterns.
     */
    public array $filters = [];
}
