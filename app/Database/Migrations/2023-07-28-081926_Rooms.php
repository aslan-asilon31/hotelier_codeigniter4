<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rooms extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'room_category_id' => [
                'type' => 'INT',
            ],
            'amenity_id' => [
                'type' => 'INT',
            ],
            'bed_type_id' => [
                'type' => 'INT',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'image' => [  // New 'image' column
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,  // Adjust this based on your requirements
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
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
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('rooms', true);
    }

    public function down()
    {
        // Drop "rooms" table
        $this->forge->dropTable('rooms', true);
    }
}
