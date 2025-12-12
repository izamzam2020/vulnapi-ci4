<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWebhooksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'event_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'raw_payload' => [
                'type' => 'JSON',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('webhooks');
    }

    public function down()
    {
        $this->forge->dropTable('webhooks');
    }
}

