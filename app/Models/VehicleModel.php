<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Vehicle Model
 * 
 * VULNERABILITY: Mass assignment - allowedFields includes sensitive fields
 * that shouldn't be user-controllable (org_id, owner_user_id, price)
 */
class VehicleModel extends Model
{
    protected $table            = 'vehicles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
    // VULNERABILITY: All fields are allowed, including sensitive ones
    protected $allowedFields    = [
        'org_id',        // Should NOT be user-controllable
        'owner_user_id', // Should NOT be user-controllable
        'make',
        'model',
        'year',
        'price'          // Should NOT be user-controllable for security
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation (intentionally weak)
    protected $validationRules = [
        'make'  => 'permit_empty|max_length[100]',
        'model' => 'permit_empty|max_length[100]',
        'year'  => 'permit_empty|integer',
    ];

    /**
     * Get vehicle with owner info
     */
    public function getWithOwner(int $vehicleId): ?array
    {
        return $this->select('vehicles.*, users.email as owner_email, organizations.name as org_name')
            ->join('users', 'users.id = vehicles.owner_user_id')
            ->join('organizations', 'organizations.id = vehicles.org_id')
            ->where('vehicles.id', $vehicleId)
            ->first();
    }

    /**
     * Get vehicles by organization
     */
    public function getByOrganization(int $orgId): array
    {
        return $this->where('org_id', $orgId)->findAll();
    }

    /**
     * Get vehicles by owner
     */
    public function getByOwner(int $userId): array
    {
        return $this->where('owner_user_id', $userId)->findAll();
    }
}

