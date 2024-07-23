<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStock extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=>'INT',
                'auto_increment'=>TRUE,
                'constraint'=>5, // Esto significa solo numeros de 5 digitos
                'null'=>FALSE
            ],
            'name'=>[
                'type'=>'VARCHAR',
                'constraint'=>'250',
                'null'=>FALSE
            ],
            'quantity'=>[
                'type'=>'INT',
                'null'=>FALSE
            ],
            'price'=>[
                'type'=>'DECIMAL',
                'constraint' => '10,2',
                'null'=>FALSE
            ]
        ]);        
        $this->forge->addKey('id', true);
        $this->forge->createTable('stock');
    }

    public function down()
    {
        $this->forge->dropTable('stock');
    }
}
