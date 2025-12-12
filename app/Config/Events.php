<?php

namespace Config;

use CodeIgniter\Events\Events;
use CodeIgniter\Exceptions\FrameworkException;

/**
 * Events Configuration
 */
Events::on('pre_system', static function (): void {
    // Skip this in testing environment
    $env = defined('ENVIRONMENT') ? ENVIRONMENT : 'production';
    
    if ($env !== 'testing') {
        if (ini_get('zlib.output_compression')) {
            throw FrameworkException::forEnabledZlibOutputCompression();
        }

        while (ob_get_level() > 0) {
            ob_end_flush();
        }

        ob_start(static fn ($buffer) => $buffer);
    }
});

Events::on('DBQuery', static function (\CodeIgniter\Database\Query $query): void {
    // Log queries if needed
});
