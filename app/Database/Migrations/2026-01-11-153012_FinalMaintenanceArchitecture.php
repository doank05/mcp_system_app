<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FinalMaintenanceArchitecture extends Migration
{
    public function up()
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Tambah tipe_pekerjaan ke tabel pekerjaan
        |--------------------------------------------------------------------------
        */
        if (! $this->db->fieldExists('tipe_pekerjaan', 'pekerjaan')) {
            $this->forge->addColumn('pekerjaan', [
                'tipe_pekerjaan' => [
                    'type'       => 'ENUM',
                    'constraint' => ['engine', 'non_engine'],
                    'after'      => 'id',
                ],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Tambah pekerjaan_id ke engine_maintenance
        |--------------------------------------------------------------------------
        */
        if (! $this->db->fieldExists('pekerjaan_id', 'engine_maintenance')) {
            $this->forge->addColumn('engine_maintenance', [
                'pekerjaan_id' => [
                    'type' => 'INT',
                    'after' => 'id',
                ],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Buat tabel nonengine_maintenance (AMAN)
        |--------------------------------------------------------------------------
        */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pekerjaan_id' => [
                'type' => 'INT',
            ],
            'idBarang' => [
                'type' => 'INT',
            ],
            'nama_pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tanggal_mulai' => [
                'type' => 'DATE',
            ],
            'tanggal_selesai' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'bagian' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);

        // 🔑 PARAMETER TRUE = IF NOT EXISTS
        $this->forge->createTable('nonengine_maintenance', true);
    }

    public function down()
    {
        $this->forge->dropTable('nonengine_maintenance', true);

        if ($this->db->fieldExists('pekerjaan_id', 'engine_maintenance')) {
            $this->forge->dropColumn('engine_maintenance', 'pekerjaan_id');
        }

        if ($this->db->fieldExists('tipe_pekerjaan', 'pekerjaan')) {
            $this->forge->dropColumn('pekerjaan', 'tipe_pekerjaan');
        }
    }
}
