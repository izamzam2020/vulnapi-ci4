<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * VulnAPI Routes Configuration
 * 
 * WARNING: Some routes intentionally lack authentication/authorization
 * for educational security testing purposes.
 */

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Home::index');

// API v1 Routes Group
$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    
    // ============================================
    // AUTH ROUTES - Public
    // ============================================
    $routes->post('auth/login', 'AuthController::login');
    $routes->post('auth/register', 'AuthController::register');
    
    // ============================================
    // VEHICLES ROUTES
    // VULNERABILITY: Mixed auth - some endpoints unprotected
    // ============================================
    $routes->get('vehicles', 'VehiclesController::index', ['filter' => 'jwt']);
    $routes->get('vehicles/(:num)', 'VehiclesController::show/$1', ['filter' => 'jwt']); // IDOR vulnerable
    $routes->post('vehicles', 'VehiclesController::create', ['filter' => 'jwt']); // Mass assignment vulnerable
    $routes->patch('vehicles/(:num)', 'VehiclesController::update/$1', ['filter' => 'jwt']); // Mass assignment + missing authz
    $routes->delete('vehicles/(:num)', 'VehiclesController::delete/$1', ['filter' => 'jwt']); // Missing authorization
    
    // ============================================
    // ADMIN ROUTES  
    // VULNERABILITY: No admin role check on some endpoints
    // ============================================
    $routes->get('admin/users', 'AdminController::listUsers', ['filter' => 'jwt']); // No role check!
    $routes->delete('admin/users/(:num)', 'AdminController::deleteUser/$1', ['filter' => 'jwt']); // HAS role check - use JWT forgery!
    $routes->get('admin/stats', 'AdminController::stats'); // VULNERABILITY: No auth at all
    
    // ============================================
    // PAYMENTS ROUTES
    // VULNERABILITY: Price override, webhook forgery
    // ============================================
    $routes->post('payments/checkout', 'PaymentsController::checkout', ['filter' => 'jwt']);
    $routes->post('payments/webhook', 'PaymentsController::webhook'); // No signature validation
    $routes->get('payments', 'PaymentsController::index', ['filter' => 'jwt']);
    $routes->get('payments/(:num)', 'PaymentsController::show/$1', ['filter' => 'jwt']); // IDOR
    
    // ============================================
    // UPLOAD ROUTES
    // VULNERABILITY: Insecure file upload
    // ============================================
    $routes->post('uploads', 'UploadsController::upload', ['filter' => 'jwt']);
    $routes->get('uploads', 'UploadsController::list'); // No auth - info disclosure
    
    // ============================================
    // DEBUG ROUTES
    // VULNERABILITY: Weak token protection
    // ============================================
    $routes->post('debug/reset', 'DebugController::resetDatabase');
    $routes->get('debug/info', 'DebugController::info'); // Exposes system info
    
    // ============================================
    // ORGANIZATIONS ROUTES
    // ============================================
    $routes->get('organizations', 'OrganizationsController::index', ['filter' => 'jwt']);
    $routes->get('organizations/(:num)', 'OrganizationsController::show/$1', ['filter' => 'jwt']); // IDOR
});

// Catch-all for 404s
$routes->set404Override(static function () {
    return service('response')
        ->setStatusCode(404)
        ->setJSON([
            'status' => 'error',
            'message' => 'Endpoint not found'
        ]);
});

