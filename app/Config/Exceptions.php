<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Debug\ExceptionHandler;
use CodeIgniter\Debug\ExceptionHandlerInterface;
use Psr\Log\LogLevel;

/**
 * Exceptions Configuration
 * 
 * VULNERABILITY: Verbose error messages enabled
 */
class Exceptions extends BaseConfig
{
    /**
     * Log all exceptions
     */
    public bool $log = true;

    /**
     * Don't ignore any status codes
     */
    public array $ignoreCodes = [];

    /**
     * Error views path
     */
    public string $errorViewPath = APPPATH . 'Views/errors';

    /**
     * Hide sensitive data paths - DISABLED for learning
     * VULNERABILITY: Full paths exposed in errors
     */
    public bool $sensitiveDataInTraceHidden = false;

    /**
     * Exception handler
     */
    public function handler(int $statusCode, \Throwable $exception): ExceptionHandlerInterface
    {
        return new ExceptionHandler($this);
    }
}

