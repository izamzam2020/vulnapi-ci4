<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Cache\Handlers\DummyHandler;
use CodeIgniter\Cache\Handlers\FileHandler;
use CodeIgniter\Cache\Handlers\MemcachedHandler;
use CodeIgniter\Cache\Handlers\PredisHandler;
use CodeIgniter\Cache\Handlers\RedisHandler;
use CodeIgniter\Cache\Handlers\WincacheHandler;

/**
 * Cache Configuration
 */
class Cache extends BaseConfig
{
    /**
     * Primary Handler
     */
    public string $handler = 'file';

    /**
     * Backup Handler
     */
    public string $backupHandler = 'dummy';

    /**
     * Cache key prefix
     */
    public string $prefix = '';

    /**
     * Default TTL
     */
    public int $ttl = 60;

    /**
     * Reserved Characters
     */
    public string $reservedCharacters = '{}()/\@:';

    /**
     * Cache Query String
     */
    public bool|array $cacheQueryString = false;

    /**
     * File Handler settings
     */
    public array $file = [
        'storePath' => WRITEPATH . 'cache/',
        'mode'      => 0640,
    ];

    /**
     * Memcached settings
     */
    public array $memcached = [
        'host'   => '127.0.0.1',
        'port'   => 11211,
        'weight' => 1,
        'raw'    => false,
    ];

    /**
     * Redis settings
     */
    public array $redis = [
        'host'     => '127.0.0.1',
        'password' => null,
        'port'     => 6379,
        'timeout'  => 0,
        'database' => 0,
    ];

    /**
     * Valid cache handlers
     */
    public array $validHandlers = [
        'dummy'     => DummyHandler::class,
        'file'      => FileHandler::class,
        'memcached' => MemcachedHandler::class,
        'predis'    => PredisHandler::class,
        'redis'     => RedisHandler::class,
        'wincache'  => WincacheHandler::class,
    ];
}
