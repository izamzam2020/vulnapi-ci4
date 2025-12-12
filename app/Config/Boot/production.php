<?php

/**
 * Production Bootstrap
 * 
 * Note: In VulnAPI, even production mode is intentionally insecure for learning.
 */

// Show all errors (intentionally insecure)
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Don't define ENVIRONMENT here - let .env handle it

