<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_product extends CI_Model {

    const TABLE        = 'products';
    const IMAGES_TABLE = 'product_images';
    const UPLOAD_DIR   = 'resources/imgs/products/';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // -------------------------------------------------------------------------
    // Admin CRUD
    // -------------------------------------------------------------------------

    public function add($data, $imageUrls = []) {
        $data['slug']       = $this->_uniqueSlug($this->_makeSlug($data['name']));
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->insert(self::TABLE, $data);
        $id = $this->db->insert_id();
        if ($id && !empty($imageUrls)) {
            $this->addImages($id, $imageUrls);
        }
        return $id;
    }

    public function update($id, $data, $newImageUrls = []) {
        $current = $this->getById($id);
        if ($current && $this->_makeSlug($data['name']) !== $current['slug']) {
            $data['slug'] = $this->_uniqueSlug($this->_makeSlug($data['name']), $id);
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id)->update(self::TABLE, $data);
        if (!empty($newImageUrls)) {
            $this->addImages($id, $newImageUrls);
        }
    }

    public function delete($id) {
        $this->db->where('product_id', $id)->delete(self::IMAGES_TABLE);
        $this->db->where('id', $id)->delete(self::TABLE);
    }

    public function getById($id) {
        $product = $this->db->where('id', $id)->get(self::TABLE)->row_array();
        if (!$product) return null;
        $product['images'] = $this->getImages($id);
        return $product;
    }

    public function getBySlug($slug) {
        $product = $this->db->where('slug', $slug)->where('status', 1)->get(self::TABLE)->row_array();
        if (!$product) return null;
        $product['images'] = $this->getImages($product['id']);
        return $product;
    }

    public function getAll($page = 1) {
        $offset = ($page - 1) * ITEM_PER_PAGE;
        return $this->db->order_by('display_order', 'ASC')
                        ->order_by('created_at', 'DESC')
                        ->limit(ITEM_PER_PAGE, $offset)
                        ->get(self::TABLE)->result_array();
    }

    public function countAll() {
        return $this->db->count_all(self::TABLE);
    }

    // -------------------------------------------------------------------------
    // Public queries
    // -------------------------------------------------------------------------

    public function getPublished() {
        $products = $this->db->where('status', 1)
                             ->order_by('display_order', 'ASC')
                             ->order_by('created_at', 'DESC')
                             ->get(self::TABLE)->result_array();
        if (empty($products)) return [];

        $ids    = array_column($products, 'id');
        $images = $this->db->where_in('product_id', $ids)
                           ->order_by('sort_order', 'ASC')
                           ->get(self::IMAGES_TABLE)->result_array();

        $grouped = [];
        foreach ($images as $img) {
            $grouped[$img['product_id']][] = $img;
        }
        foreach ($products as &$p) {
            $p['images']     = $grouped[$p['id']] ?? [];
            $p['main_image'] = !empty($p['images']) ? $p['images'][0]['image_url'] : '';
        }
        return $products;
    }

    // -------------------------------------------------------------------------
    // Image management
    // -------------------------------------------------------------------------

    public function getImages($productId) {
        return $this->db->where('product_id', $productId)
                        ->order_by('sort_order', 'ASC')
                        ->get(self::IMAGES_TABLE)->result_array();
    }

    public function addImages($productId, $imageUrls) {
        $base = (int) $this->db->where('product_id', $productId)
                               ->count_all_results(self::IMAGES_TABLE);
        foreach (array_values($imageUrls) as $i => $url) {
            $this->db->insert(self::IMAGES_TABLE, [
                'product_id' => $productId,
                'image_url'  => $url,
                'sort_order' => $base + $i,
            ]);
        }
    }

    public function getImageById($id) {
        return $this->db->where('id', $id)->get(self::IMAGES_TABLE)->row_array();
    }

    public function deleteImage($id) {
        $img = $this->getImageById($id);
        if ($img) {
            $this->db->where('id', $id)->delete(self::IMAGES_TABLE);
        }
        return $img;
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    public function formatPrice($price) {
        return number_format((int) $price, 0, ',', '.') . ' đ';
    }

    private function _makeSlug($text) {
        $utf8 = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ|Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        ];
        foreach ($utf8 as $ascii => $uni) {
            $text = preg_replace("/($uni)/i", $ascii, $text);
        }
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        return strtolower($text) ?: 'product';
    }

    private function _uniqueSlug($slug, $excludeId = null) {
        $base  = $slug;
        $count = 0;
        while (true) {
            $this->db->where('slug', $slug);
            if ($excludeId) $this->db->where('id !=', $excludeId);
            if ($this->db->count_all_results(self::TABLE) === 0) break;
            $slug = $base . '-' . (++$count);
        }
        return $slug;
    }
}
