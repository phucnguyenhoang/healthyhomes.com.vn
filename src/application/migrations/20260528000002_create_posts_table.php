<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_posts_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => FALSE,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => FALSE,
            ],
            'thumbnail' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => TRUE,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'content' => [
                'type' => 'LONGTEXT',
                'null' => TRUE,
            ],
            'tags' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => TRUE,
            ],
            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => FALSE,
                'default'    => 0,
            ],
            'seo_keywords' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => TRUE,
            ],
            'meta_description' => [
                'type'       => 'VARCHAR',
                'constraint' => 300,
                'null'       => TRUE,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => FALSE,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('slug');
        $this->dbforge->add_key('status');
        $this->dbforge->create_table('posts', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('posts', TRUE);
    }
}
