<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\OrganizationModel;
use App\Models\UserModel;
use App\Models\VehicleModel;

/**
 * Organizations Controller
 * 
 * VULNERABILITY: IDOR - Can view any organization's details
 */
class OrganizationsController extends BaseController
{
    protected OrganizationModel $orgModel;
    protected UserModel $userModel;
    protected VehicleModel $vehicleModel;

    public function __construct()
    {
        $this->orgModel = new OrganizationModel();
        $this->userModel = new UserModel();
        $this->vehicleModel = new VehicleModel();
    }

    /**
     * GET /api/organizations
     * 
     * List all organizations
     */
    public function index()
    {
        $organizations = $this->orgModel->findAll();

        return $this->success([
            'organizations' => $organizations,
            'count'         => count($organizations)
        ]);
    }

    /**
     * GET /api/organizations/{id}
     * 
     * VULNERABILITY: IDOR - Can view any organization's data
     * including users and vehicles belonging to that org
     */
    public function show($id = null)
    {
        if (!$id) {
            return $this->error('Organization ID is required', 400);
        }

        // VULNERABILITY: No check if user belongs to this org
        $org = $this->orgModel->find($id);

        if (!$org) {
            return $this->error('Organization not found', 404);
        }

        // VULNERABILITY: Exposing all org data including users
        $users = $this->userModel
            ->select('id, email, role, created_at')
            ->where('org_id', $id)
            ->findAll();

        $vehicles = $this->vehicleModel
            ->where('org_id', $id)
            ->findAll();

        return $this->success([
            'organization' => $org,
            'users'        => $users,
            'vehicles'     => $vehicles
        ]);
    }
}

