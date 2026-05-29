<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_post extends CI_Model {

    const TABLE    = 'posts';
    const PER_PAGE = 9;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // -------------------------------------------------------------------------
    // Admin CRUD
    // -------------------------------------------------------------------------

    public function add($data) {
        $data['slug']       = $this->_uniqueSlug($this->_makeSlug($data['title']));
        $data['tags']       = $this->_normalizeTags($data['tags'] ?? '');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->insert(self::TABLE, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        if (!empty($data['tags'])) {
            $data['tags'] = $this->_normalizeTags($data['tags']);
        }
        $current = $this->getById($id);
        if ($current && $this->_makeSlug($data['title']) !== $current['slug']) {
            $data['slug'] = $this->_uniqueSlug($this->_makeSlug($data['title']), $id);
        }
        $this->db->where('id', $id)->update(self::TABLE, $data);
    }

    public function delete($id) {
        $this->db->where('id', $id)->delete(self::TABLE);
    }

    public function getById($id) {
        return $this->db->where('id', $id)->get(self::TABLE)->row_array();
    }

    public function getAll($page = 1) {
        $offset = ($page - 1) * ITEM_PER_PAGE;
        return $this->db->order_by('created_at', 'DESC')
                        ->limit(ITEM_PER_PAGE, $offset)
                        ->get(self::TABLE)->result_array();
    }

    public function countAll() {
        return $this->db->count_all(self::TABLE);
    }

    // -------------------------------------------------------------------------
    // Public queries
    // -------------------------------------------------------------------------

    public function getPublished($page = 1) {
        $offset = ($page - 1) * self::PER_PAGE;
        return $this->db->select('id,title,slug,thumbnail,description,tags,created_at')
                        ->where('status', 1)
                        ->order_by('created_at', 'DESC')
                        ->limit(self::PER_PAGE, $offset)
                        ->get(self::TABLE)->result_array();
    }

    public function countPublished() {
        return $this->db->where('status', 1)->count_all_results(self::TABLE);
    }

    public function getBySlug($slug) {
        return $this->db->where('slug', $slug)->where('status', 1)->get(self::TABLE)->row_array();
    }

    public function getByTag($tag, $page = 1) {
        $offset   = ($page - 1) * self::PER_PAGE;
        $safeTag  = $this->db->escape_str($tag);
        return $this->db->select('id,title,slug,thumbnail,description,tags,created_at')
                        ->where('status', 1)
                        ->where("FIND_IN_SET('{$safeTag}', tags)", NULL, FALSE)
                        ->order_by('created_at', 'DESC')
                        ->limit(self::PER_PAGE, $offset)
                        ->get(self::TABLE)->result_array();
    }

    public function countByTag($tag) {
        $safeTag = $this->db->escape_str($tag);
        return $this->db->where('status', 1)
                        ->where("FIND_IN_SET('{$safeTag}', tags)", NULL, FALSE)
                        ->count_all_results(self::TABLE);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    public function parseTags($tagString) {
        if (empty($tagString)) return [];
        return array_values(array_filter(array_map('trim', explode(',', $tagString))));
    }

    private function _normalizeTags($tagString) {
        $tags = array_filter(array_map('trim', explode(',', $tagString)));
        return implode(',', $tags);
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
        return strtolower($text) ?: 'post';
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
