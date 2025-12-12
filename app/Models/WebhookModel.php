<?php

namespace App\Models;

use CodeIgniter\Model;

class WebhookModel extends Model
{
    protected $table            = 'webhooks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['event_name', 'raw_payload'];

    // Dates
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
}

