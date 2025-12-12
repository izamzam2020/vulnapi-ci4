<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * VulnAPI Database Seeder
 * 
 * Seeds the database with sample data for testing vulnerabilities.
 */
class VulnApiSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        // Clear existing data in reverse order of dependencies
        $this->db->table('webhooks')->truncate();
        $this->db->table('payments')->truncate();
        $this->db->table('vehicles')->truncate();
        $this->db->table('users')->truncate();
        $this->db->table('organizations')->truncate();

        // Re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        // Seed Organizations
        $organizations = [
            [
                'id'         => 1,
                'name'       => 'Acme Corp',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'         => 2,
                'name'       => 'TechStart Inc',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('organizations')->insertBatch($organizations);

        // Seed Users
        // Password for all users: password123
        $passwordHash = password_hash('password123', PASSWORD_DEFAULT);
        
        $users = [
            [
                'id'            => 1,
                'org_id'        => 1,
                'email'         => 'userA@acme.com',
                'password_hash' => $passwordHash,
                'role'          => 'user',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'id'            => 2,
                'org_id'        => 2,
                'email'         => 'userB@techstart.com',
                'password_hash' => $passwordHash,
                'role'          => 'user',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'id'            => 3,
                'org_id'        => 1,
                'email'         => 'admin@acme.com',
                'password_hash' => $passwordHash,
                'role'          => 'admin',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('users')->insertBatch($users);

        // Seed Vehicles
        $vehicles = [
            [
                'id'            => 1,
                'org_id'        => 1,
                'owner_user_id' => 1,
                'make'          => 'Toyota',
                'model'         => 'Camry',
                'year'          => 2022,
                'price'         => 28999.99,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'id'            => 2,
                'org_id'        => 1,
                'owner_user_id' => 1,
                'make'          => 'Honda',
                'model'         => 'Accord',
                'year'          => 2023,
                'price'         => 32500.00,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'id'            => 3,
                'org_id'        => 2,
                'owner_user_id' => 2,
                'make'          => 'Tesla',
                'model'         => 'Model 3',
                'year'          => 2023,
                'price'         => 45000.00,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'id'            => 4,
                'org_id'        => 2,
                'owner_user_id' => 2,
                'make'          => 'BMW',
                'model'         => 'M3',
                'year'          => 2021,
                'price'         => 72000.00,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'id'            => 5,
                'org_id'        => 1,
                'owner_user_id' => 3,
                'make'          => 'Porsche',
                'model'         => '911',
                'year'          => 2022,
                'price'         => 120000.00,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('vehicles')->insertBatch($vehicles);

        // Seed Payments
        $payments = [
            [
                'id'         => 1,
                'vehicle_id' => 1,
                'user_id'    => 1,
                'amount'     => 28999.99,
                'status'     => 'paid',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'         => 2,
                'vehicle_id' => 3,
                'user_id'    => 2,
                'amount'     => 45000.00,
                'status'     => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'         => 3,
                'vehicle_id' => 5,
                'user_id'    => 3,
                'amount'     => 120000.00,
                'status'     => 'paid',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('payments')->insertBatch($payments);

        // Seed Webhooks (example entries)
        $webhooks = [
            [
                'id'          => 1,
                'event_name'  => 'payment.completed',
                'raw_payload' => json_encode([
                    'payment_id' => 1,
                    'amount'     => 28999.99,
                    'status'     => 'completed',
                    'timestamp'  => time(),
                ]),
                'created_at'  => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('webhooks')->insertBatch($webhooks);

        echo "VulnAPI database seeded successfully!\n";
        echo "Users created:\n";
        echo "  - userA@acme.com (Org 1, User role)\n";
        echo "  - userB@techstart.com (Org 2, User role)\n";
        echo "  - admin@acme.com (Org 1, Admin role)\n";
        echo "  Password for all: password123\n";
    }
}
