<?php

/**
 * Development Bootstrap
 * 
 * VULNERABILITY: All errors displayed for learning purposes.
 */

// Show all errors
ini_set('display_errors', '1');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

// Define ENVIRONMENT
defined('ENVIRONMENT') || define('ENVIRONMENT', 'development');

