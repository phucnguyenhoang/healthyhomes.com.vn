<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_admin_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => FALSE,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => TRUE,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('admin', TRUE);

        // Seed default admin account (only if table is empty)
        if ($this->db->count_all('admin') === 0) {
            $this->db->insert('admin', [
                'username'   => 'admin',
                'password'   => md5('Admin@123'),
                'email'      => 'admin@healthyhomes.com.vn',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public function down() {
        $this->dbforge->drop_table('admin', TRUE);
    }
}
