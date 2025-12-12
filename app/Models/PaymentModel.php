<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Payment Model
 * 
 * VULNERABILITY: Amount field is in allowedFields,
 * allowing client-side price manipulation
 */
class PaymentModel extends Model
{
    protected $table            = 'payments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
    // VULNERABILITY: amount should not be client-controllable
    protected $allowedFields    = [
        'vehicle_id',
        'user_id',
        'amount',  // Client can override this!
        'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get payment with vehicle and user info
     */
    public function getWithDetails(int $paymentId): ?array
    {
        return $this->select('payments.*, vehicles.make, vehicles.model, vehicles.price as vehicle_price, users.email')
            ->join('vehicles', 'vehicles.id = payments.vehicle_id')
            ->join('users', 'users.id = payments.user_id')
            ->where('payments.id', $paymentId)
            ->first();
    }

    /**
     * Get payments by user
     */
    public function getByUser(int $userId): array
    {
        return $this->where('user_id', $userId)->findAll();
    }
}

