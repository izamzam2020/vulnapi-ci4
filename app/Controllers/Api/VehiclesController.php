<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\VehicleModel;

/**
 * Vehicles Controller
 * 
 * VULNERABILITIES:
 * - IDOR: Can access any vehicle regardless of org/ownership
 * - Mass Assignment: Can set org_id, owner_user_id, price
 * - Missing Authorization: No ownership check on update/delete
 * - No rate limiting
 */
class VehiclesController extends BaseController
{
    protected VehicleModel $vehicleModel;

    public function __construct()
    {
        $this->vehicleModel = new VehicleModel();
    }

    /**
     * GET /api/vehicles
     * 
     * List all vehicles (should filter by user's org, but doesn't fully)
     */
    public function index()
    {
        $user = $this->getAuthUser();
        
        // VULNERABILITY: Returns ALL vehicles, not filtered properly
        // A secure implementation would filter by org_id
        $vehicles = $this->vehicleModel->findAll();

        return $this->success([
            'vehicles' => $vehicles,
            'count'    => count($vehicles)
        ]);
    }

    /**
     * GET /api/vehicles/{id}
     * 
     * VULNERABILITY: IDOR - Returns any vehicle without checking:
     * - Organization membership
     * - Ownership
     * - Role permissions
     */
    public function show($id = null)
    {
        if (!$id) {
            return $this->error('Vehicle ID is required', 400);
        }

        // VULNERABILITY: No authorization check - returns any vehicle
        $vehicle = $this->vehicleModel->getWithOwner((int)$id);

        if (!$vehicle) {
            return $this->error('Vehicle not found', 404);
        }

        // Should check: Does this user have permission to view this vehicle?
        // $user = $this->getAuthUser();
        // if ($vehicle['org_id'] !== $user->org_id) { return $this->error('Forbidden', 403); }

        return $this->success(['vehicle' => $vehicle]);
    }

    /**
     * POST /api/vehicles
     * 
     * VULNERABILITY: Mass Assignment
     * - Client can set org_id to any organization
     * - Client can set owner_user_id to any user
     * - Client can set price to any value
     */
    public function create()
    {
        $user = $this->getAuthUser();
        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->error('Invalid JSON payload', 400);
        }

        // VULNERABILITY: Directly using user input for sensitive fields
        // The model's allowedFields permits org_id, owner_user_id, price
        // A secure implementation would:
        // $data = [
        //     'org_id' => $user->org_id,  // Force from auth
        //     'owner_user_id' => $user->user_id,  // Force from auth
        //     'make' => $json['make'],
        //     'model' => $json['model'],
        //     'year' => $json['year'],
        //     'price' => calculatePriceServerSide(),
        // ];

        // Instead, we just pass everything through:
        $vehicleId = $this->vehicleModel->insert($json);

        if (!$vehicleId) {
            // VULNERABILITY: May leak validation errors
            return $this->error('Failed to create vehicle: ' . implode(', ', $this->vehicleModel->errors()), 400);
        }

        $vehicle = $this->vehicleModel->find($vehicleId);

        return $this->success([
            'vehicle' => $vehicle,
            'message' => 'Vehicle created successfully'
        ], 201);
    }

    /**
     * PATCH /api/vehicles/{id}
     * 
     * VULNERABILITIES:
     * - Mass Assignment: Can update org_id, owner_user_id, price
     * - Missing Authorization: No ownership check
     */
    public function update($id = null)
    {
        if (!$id) {
            return $this->error('Vehicle ID is required', 400);
        }

        $vehicle = $this->vehicleModel->find($id);

        if (!$vehicle) {
            return $this->error('Vehicle not found', 404);
        }

        // VULNERABILITY: No authorization check
        // Should verify: $vehicle['owner_user_id'] === $user->user_id
        // Or: $vehicle['org_id'] === $user->org_id && $user->role === 'admin'

        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->error('Invalid JSON payload', 400);
        }

        // VULNERABILITY: Mass assignment - all fields from JSON are applied
        $updated = $this->vehicleModel->update($id, $json);

        if (!$updated) {
            return $this->error('Failed to update vehicle', 400);
        }

        $vehicle = $this->vehicleModel->find($id);

        return $this->success([
            'vehicle' => $vehicle,
            'message' => 'Vehicle updated successfully'
        ]);
    }

    /**
     * DELETE /api/vehicles/{id}
     * 
     * VULNERABILITY: Missing Authorization
     * - Any authenticated user can delete any vehicle
     */
    public function delete($id = null)
    {
        if (!$id) {
            return $this->error('Vehicle ID is required', 400);
        }

        $vehicle = $this->vehicleModel->find($id);

        if (!$vehicle) {
            return $this->error('Vehicle not found', 404);
        }

        // VULNERABILITY: No authorization check!
        // Any authenticated user can delete any vehicle
        
        $deleted = $this->vehicleModel->delete($id);

        if (!$deleted) {
            return $this->error('Failed to delete vehicle', 500);
        }

        return $this->success([
            'message' => 'Vehicle deleted successfully',
            'deleted_id' => $id
        ]);
    }
}

