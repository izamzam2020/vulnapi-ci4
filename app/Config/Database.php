<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * The default database connection.
     */
    public string $defaultGroup = 'default';

    /**
     * Default Database Connection Settings
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'db',
        'username'     => 'root',
        'password'     => 'root',
        'database'     => 'vulnapi',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true, // VULNERABILITY: SQL errors exposed in development
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_unicode_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberConnect' => false,
        'dateFormat'   => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    /**
     * Test Database Connection Settings
     */
    public array $tests = [
        'DSN'          => '',
        'hostname'     => 'db',
        'username'     => 'root',
        'password'     => 'root',
        'database'     => 'vulnapi_test',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_unicode_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberConnect' => false,
        'dateFormat'   => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        // Load from environment variables
        if (getenv('database.default.hostname')) {
            $this->default['hostname'] = getenv('database.default.hostname');
        }
        if (getenv('database.default.database')) {
            $this->default['database'] = getenv('database.default.database');
        }
        if (getenv('database.default.username')) {
            $this->default['username'] = getenv('database.default.username');
        }
        if (getenv('database.default.password')) {
            $this->default['password'] = getenv('database.default.password');
        }
        if (getenv('database.default.port')) {
            $this->default['port'] = (int) getenv('database.default.port');
        }
    }
}

