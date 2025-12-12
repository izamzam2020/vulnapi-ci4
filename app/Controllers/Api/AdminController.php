<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\VehicleModel;
use App\Models\PaymentModel;
use App\Models\OrganizationModel;

/**
 * Admin Controller
 * 
 * VULNERABILITIES:
 * - Broken Function-Level Authorization: No admin role check
 * - Any authenticated user can access admin endpoints
 * - Some endpoints have no auth at all
 */
class AdminController extends BaseController
{
    protected UserModel $userModel;
    protected VehicleModel $vehicleModel;
    protected PaymentModel $paymentModel;
    protected OrganizationModel $orgModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->vehicleModel = new VehicleModel();
        $this->paymentModel = new PaymentModel();
        $this->orgModel = new OrganizationModel();
    }

    /**
     * GET /api/admin/users
     * 
     * VULNERABILITY: No admin role check!
     * Any authenticated user can list all users.
     * Should check: if (!$this->isAdmin()) return $this->error('Forbidden', 403);
     */
    public function listUsers()
    {
        // VULNERABILITY: No role check - any JWT holder can access
        // Correct implementation would be:
        // if (!$this->isAdmin()) {
        //     return $this->error('Admin access required', 403, 'FORBIDDEN');
        // }

        $users = $this->userModel->select('id, org_id, email, role, created_at, updated_at')->findAll();

        // VULNERABILITY: Exposing all user data including password hashes would be worse
        // but we're still exposing emails and roles of all users

        return $this->success([
            'users' => $users,
            'count' => count($users)
        ]);
    }

    /**
     * GET /api/admin/stats
     * 
     * VULNERABILITY: No authentication at all!
     * This endpoint is completely public and exposes system stats.
     */
    public function stats()
    {
        // VULNERABILITY: No auth check at all - completely public

        $stats = [
            'total_users'         => $this->userModel->countAll(),
            'total_vehicles'      => $this->vehicleModel->countAll(),
            'total_payments'      => $this->paymentModel->countAll(),
            'total_organizations' => $this->orgModel->countAll(),
            'pending_payments'    => $this->paymentModel->where('status', 'pending')->countAllResults(),
            'paid_payments'       => $this->paymentModel->where('status', 'paid')->countAllResults(),
            'admin_users'         => $this->userModel->where('role', 'admin')->countAllResults(),
            // VULNERABILITY: Exposes system information
            'php_version'         => phpversion(),
            'server_time'         => date('Y-m-d H:i:s'),
            'environment'         => getenv('CI_ENVIRONMENT') ?: 'production',
        ];

        return $this->success(['stats' => $stats]);
    }

    /**
     * DELETE /api/admin/users/{id}
     * 
     * This endpoint HAS a role check - requires admin role.
     * Demonstrates why JWT forgery is dangerous: forge admin token to bypass this.
     */
    public function deleteUser($id = null)
    {
        $user = $this->getAuthUser();
        
        // This endpoint DOES check the role!
        if (!$user || $user->role !== 'admin') {
            return $this->error('Admin access required', 403, 'FORBIDDEN');
        }

        if (!$id) {
            return $this->error('User ID required', 400);
        }

        $targetUser = $this->userModel->find($id);
        if (!$targetUser) {
            return $this->error('User not found', 404);
        }

        // Don't allow deleting yourself
        if ($targetUser['id'] == $user->user_id) {
            return $this->error('Cannot delete yourself', 400);
        }

        $this->userModel->delete($id);

        return $this->success([
            'message' => 'User deleted successfully',
            'deleted_user_id' => $id
        ]);
    }
}

