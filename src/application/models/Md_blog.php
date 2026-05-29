<?php
class Md_blog extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function add($input, $isActivity = false) {
		$currDate = date("Y-m-d H:i:s");
		$data = array(
			'type' => $isActivity ? 1 : 0,
			'alias' => $this->_aliasMake($input['txtTitle']),
			'title' => htmlentities($input['txtTitle']),
			'description' => htmlentities($input['txtDescription']),
			'thumbnail' => $input['imgThumb'],
			'content' => htmlentities($input['txtContent']),
			'created_date' => $currDate,
			'updated_date' => $currDate
		);
		
		$this->db->insert('blogs', $data);
	}
	public function update($id, $input, $isActivity = false) {
		$currDate = date("Y-m-d H:i:s");
		$data = array(
			'type' => $isActivity ? 1 : 0,
			'alias' => $this->_aliasMake($input['txtTitle']),
			'title' => htmlentities($input['txtTitle']),
			'description' => htmlentities($input['txtDescription']),
			'thumbnail' => $input['imgThumb'],
			'content' => htmlentities($input['txtContent']),
			'updated_date' => $currDate
		);
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('blogs');
	}

	public function get($field = '*', $page = null, $isActivity = false) {
		$this->db->select($field);
		$this->db->where('type', $isActivity ? 1 : 0);
		$this->db->order_by('created_date', 'DESC');
		$this->db->limit(ITEM_PER_PAGE, ($page - 1)*ITEM_PER_PAGE);
		$query = $this->db->get('blogs');

		return $query->result_array();
	}

	public function getById($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('blogs');

		return $query->row_array();
	}

	public function checkExist($id) {
		$this->db->where('id', $id);
		return $this->db->count_all_results('blogs');
	}

	public function deleteById($id) {
		$this->db->where('id', $id);
		$this->db->delete('blogs');
	}

	public function countItem() {
		return $this->db->count_all('blogs');
	}

	public function countActivityItem() {
		$this->db->where('type', 1);
		return $this->db->count_all_results('blogs');
	}

	private function _aliasMake($text) {
		$text = $this->_utf8convert($text);
	  	// replace non letter or digits by -
	  	$text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  	// transliterate
	  	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  	// remove unwanted characters
	  	$text = preg_replace('~[^-\w]+~', '', $text);

	  	// trim
	  	$text = trim($text, '-');

	  	// remove duplicate -
	  	$text = preg_replace('~-+~', '-', $text);

	  	// lowercase
	  	$text = strtolower($text);

	  	if (empty($text)) {
	    	return 'n-a';
	  	}

	  	return $text;
	}

	private function _utf8convert($str) {

        if(!$str) return false;

        $utf8 = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'd'=>'đ|Đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);

		return $str;
	}
}