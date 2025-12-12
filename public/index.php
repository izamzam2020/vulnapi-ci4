<?php

declare(strict_types=1);

/**
 * VulnAPI - CodeIgniter 4 Front Controller
 * 
 * WARNING: This application contains intentional security vulnerabilities
 * for educational purposes. DO NOT use in production.
 */

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
chdir(FCPATH);

// Define ROOTPATH
define('ROOTPATH', realpath(FCPATH . '../') . DIRECTORY_SEPARATOR);

// Check for Composer autoloader
if (!is_file(ROOTPATH . 'vendor/autoload.php')) {
    die('ERROR: Composer dependencies not installed! Please run: composer install');
}

// Load Composer autoloader
require ROOTPATH . 'vendor/autoload.php';

// Load our paths config file
require ROOTPATH . 'app/Config/Paths.php';

$paths = new Config\Paths();

// Boot the web application
exit(\CodeIgniter\Boot::bootWeb($paths));
