<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model(['Md_admin', 'Md_blog', 'Md_gift']);
		$this->load->helper('blog');
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('home');
		$this->load->view('layout/footer');
	}

	public function product()
	{
		$this->load->view('layout/header', array('title' => 'Sản phẩm'));
		$this->load->view('product');
		$this->load->view('layout/footer');
	}

	public function cookingSystem()
	{
		$this->load->view('layout/header', array('title' => 'Các Sản Phẩm Khác'));
		$this->load->view('cooking-system', [
			'gifts' => $this->Md_gift->get()
		]);
		$this->load->view('layout/footer');
	}

	public function howToWork()
	{
		$this->load->view('layout/header', array('title' => 'Cách thức vận hành'));
		$this->load->view('how-to-work');
		$this->load->view('layout/footer');
	}

	public function howToBuy()
	{
		$this->load->view('layout/header', array('title' => 'Cách thức mua hàng'));
		$this->load->view('how-to-buy');
		$this->load->view('layout/footer');
	}

	public function tool()
	{
		$this->load->view('layout/header', array('title' => 'Dụng cụ'));
		$this->load->view('tool');
		$this->load->view('layout/footer');
	}

	public function aboutUs()
	{
		$this->load->view('layout/header', array('title' => 'Giới thiệu về chúng tôi'));
		$this->load->view('about-us');
		$this->load->view('layout/footer');
	}

	public function history()
	{
		$this->load->view('layout/header', array('title' => 'Lịch sử thành lập'));
		$this->load->view('history');
		$this->load->view('layout/footer');
	}

	public function customerFeed()
	{
		$this->load->view('layout/header', array('title' => 'Chứng thực từ khách hàng'));
		$this->load->view('customer-feed');
		$this->load->view('layout/footer');
	}

	public function certification()
	{
		$this->load->view('layout/header', array('title' => 'Giấy chứng nhận'));
		$this->load->view('certification');
		$this->load->view('layout/footer');
	}

	public function starMember()
	{
		$this->load->view('layout/header', array('title' => 'Người nổi tiếng'));
		$this->load->view('star-member');
		$this->load->view('layout/footer');
	}
	public function starMemberDetail($id)
	{
		$this->load->view('star/star' . $id);
	}

	public function support()
	{
		$this->load->view('layout/header', array('title' => 'Hỗ trợ'));
		$this->load->view('support');
		$this->load->view('layout/footer');
	}

	public function customerWarning()
	{
		$this->load->view('layout/header', array('title' => 'Khách hàng chú ý'));
		$this->load->view('customer-warning');
		$this->load->view('layout/footer');
	}

	public function videos()
	{
		$this->load->view('layout/header', array('title' => 'Videos'));
		$this->load->view('videos');
		$this->load->view('layout/footer');
	}

	public function userManual()
	{
		$this->load->view('layout/header', array('title' => 'Hướng dẫn sử dụng'));
		$this->load->view('user-manual');
		$this->load->view('layout/footer');
	}

	public function cleaningTip()
	{
		$this->load->view('layout/header', array('title' => 'Những mẹo làm sạch'));
		$this->load->view('cleaning-tip');
		$this->load->view('layout/footer');
	}

	public function friendlyQA()
	{
		$this->load->view('layout/header', array('title' => 'Những câu hỏi thường gặp'));
		$this->load->view('friendly-qa');
		$this->load->view('layout/footer');
	}

	public function dataSheet()
	{
		$this->load->view('layout/header', array('title' => 'Dữ liệu tham khảo'));
		$this->load->view('datasheet');
		$this->load->view('layout/footer');
	}

	public function supplies()
	{
		$this->load->view('layout/header', array('title' => 'Đặt mua phụ kiện'));
		$this->load->view('supplies');
		$this->load->view('layout/footer');
	}

	public function customers()
	{
		$this->load->view('layout/header', array('title' => 'Khách hàng'));
		$this->load->view('customers');
		$this->load->view('layout/footer');
	}

	public function contactUs()
	{
// 		$userFocus = array(
// 			1 => 'Dịch vụ/Linh kiện',
// 			2 => 'Bảo hành',
// 			3 => 'Nhà phân phối Rainbow',
// 			4 => 'Thông tin sản phẩm',
// 			5 => 'Dùng thử tại nhà',
// 			6 => 'Hưỡng dẫn sử dụng'
// 		);

// 		if ($this->input->method() == 'post') {
// 			$frmData = $this->input->post();
// 			if (!empty($frmData['userFocus'])) {
// 				$tmp = array();
// 				foreach ($frmData['userFocus'] as $key) {
// 					$tmp[] = $userFocus[$key];
// 				}
// 				$frmData['userFocus'] = $tmp;
// 			}
// 			//var_dump($frmData);die();
// 			$this->__sendContactUsEmail($frmData);
// 		}
		$this->load->view('layout/header', array('title' => 'Liên hệ chúng tôi'));
		$this->load->view('contact-us');
		$this->load->view('layout/footer');
	}

	public function requestDemo()
	{
// 		if ($this->input->method() == 'post') {
// 			$frmData = $this->input->post();
// 			$this->__sendRequestDemoEmail($frmData);
// 		}
		$this->load->view('layout/header', array('title' => 'Yêu cầu dùng thử tại nhà'));
		$this->load->view('request-demo');
		$this->load->view('layout/footer');
	}

	/* Add blog page here */
	public function blogs()
	{
		$numBlogs = $this->Md_blog->countItem();
		$totalPage = floor($numBlogs / ITEM_PER_PAGE);
		if ($numBlogs % ITEM_PER_PAGE > 0) $totalPage = $totalPage + 1;
		$currPage = empty($this->input->get('page')) ? 1 : $this->input->get('page');
		if ($currPage < 0 || ($totalPage > 0 && $currPage > $totalPage)) show_404();
		$pagination = array();
		if ($numBlogs > ITEM_PER_PAGE) {
			$pagination['numPage'] = $totalPage;
			$pagination['currPage'] = $currPage;
		}

		$blogs = $this->Md_blog->get('id, title, description, thumbnail, alias', $currPage);

		$contentData = array(
			'blogs' => $blogs,
			'pagination' => $pagination
		);
		//var_dump($contentData);
		$this->load->view('layout/header', array('title' => 'Blogs'));
		$this->load->view('blogs', $contentData);
		$this->load->view('layout/footer');
	}

	public function blogView($alias)
	{
		$alias = explode('-', $alias);
		$id = end($alias);
		$article = $this->Md_blog->getById($id);
		if (empty($article)) show_404();

		$headerData = array(
			'title' => $article['title'],
			'metadata' => [
				'thumbnail' => !empty($article['thumbnail']) ? $article['thumbnail'] : '/resources/imgs/main-logo.png',
				'desc' => $article['description']
			]
		);
		$this->load->view('layout/header', $headerData);
		$this->load->view('blog-view', $article);
		$this->load->view('layout/footer');
	}

	/** Begin activities */

	public function activities()
	{
		$numActivities = $this->Md_blog->countActivityItem();
		$totalPage = floor($numActivities / ITEM_PER_PAGE);
		if ($numActivities % ITEM_PER_PAGE > 0) $totalPage = $totalPage + 1;
		$currPage = empty($this->input->get('page')) ? 1 : $this->input->get('page');
		if ($currPage < 0 || ($totalPage > 0 && $currPage > $totalPage)) show_404();
		$pagination = array();
		if ($numActivities > ITEM_PER_PAGE) {
			$pagination['numPage'] = $totalPage;
			$pagination['currPage'] = $currPage;
		}

		$activities = $this->Md_blog->get('id, title, description, thumbnail, alias', $currPage, true);

		$contentData = array(
			'activities' => $activities,
			'pagination' => $pagination
		);
		
		$this->load->view('layout/header', array('title' => 'Hoạt động'));
		$this->load->view('activities', $contentData);
		$this->load->view('layout/footer');
	}

	public function activityView($alias)
	{
		$alias = explode('-', $alias);
		$id = end($alias);
		$article = $this->Md_blog->getById($id);
		if (empty($article)) show_404();
		
		$headerData = array(
			'title' => $article['title'],
			'metadata' => [
				'thumbnail' => !empty($article['thumbnail']) ? $article['thumbnail'] : '/resources/imgs/main-logo.png',
				'desc' => $article['description']
			]
		);
		$data = array(
			'article' => $article
		);
		$this->load->view('layout/header', $headerData);
		$this->load->view('activity-view', $data);
		$this->load->view('layout/footer');
	}

	/** End activities */

	private function __sendContactUsEmail($data)
	{
		$this->config->load('email');
		$emailConf = $this->config->item('email');
		$this->load->library('email', $emailConf);

		$this->email->clear();
		$this->email->from($this->config->item('system_email'), $this->config->item('display_name'));
		$this->email->to($this->config->item('to'));
		$this->email->subject('Liên hệ với chúng tôi');

		$content = $this->load->view('email/contact-us', $data, true);
		$this->email->message($content);

		$result = $this->email->send();
	}

	private function __sendRequestDemoEmail($data)
	{
		$this->config->load('email');
		$emailConf = $this->config->item('email');
		$this->load->library('email', $emailConf);

		$this->email->clear();
		$this->email->from($this->config->item('system_email'), $this->config->item('display_name'));
		$this->email->to($this->config->item('to'));
		$this->email->subject('Yêu Cầu dùng thử tại nhà');

		$content = $this->load->view('email/request-demo', $data, true);
		$this->email->message($content);

		$result = $this->email->send();
	}
}
