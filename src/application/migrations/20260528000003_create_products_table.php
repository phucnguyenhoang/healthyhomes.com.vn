<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_products_table extends CI_Migration {

    public function up() {
        // Products table
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'name' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => FALSE],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => FALSE],
            'price' => ['type' => 'BIGINT', 'unsigned' => TRUE, 'null' => FALSE, 'default' => 0],
            'description' => ['type' => 'LONGTEXT', 'null' => TRUE],
            'display_order' => ['type' => 'INT', 'null' => FALSE, 'default' => 0],
            'status' => ['type' => 'TINYINT', 'constraint' => 1, 'null' => FALSE, 'default' => 0],
            'seo_keywords' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => TRUE],
            'meta_description' => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => TRUE],
            'created_at' => ['type' => 'DATETIME', 'null' => FALSE],
            'updated_at' => ['type' => 'DATETIME', 'null' => TRUE],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('slug');
        $this->dbforge->add_key('status');
        $this->dbforge->create_table('products', TRUE);

        // Product images table
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'product_id' => ['type' => 'INT', 'unsigned' => TRUE, 'null' => FALSE],
            'image_url' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => FALSE],
            'sort_order' => ['type' => 'INT', 'null' => FALSE, 'default' => 0],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('product_id');
        $this->dbforge->create_table('product_images', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('product_images', TRUE);
        $this->dbforge->drop_table('products', TRUE);
    }
}
