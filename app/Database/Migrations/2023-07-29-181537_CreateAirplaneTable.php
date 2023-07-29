<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAirplaneTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'airplane_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'airline' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'flight_number' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'departure_city' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'destination_city' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'departure_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'arrival_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'duration' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'base_price' => [
                'type' => 'int',
                'constraint' => '20',
                'null' => true,
            ],
            'selling_price' => [
                'type' => 'int',
                'constraint' => '100',
                'null' => true,
            ],
            'discount' => [
                'type' => 'decimal',
                'constraint' => '5,2',
                'null' => true,
            ],
            'available_seats' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('airplane');
    }

    public function down()
    {
        $this->forge->dropTable('airplane');
    }
}
