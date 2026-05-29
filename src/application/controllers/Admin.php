<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    const COOKIE_NAME   = 'hh_admin_auth';
    const COOKIE_EXPIRY = 259200; // 3 days

    public function __construct() {
        parent::__construct();
        $this->load->model('Md_admin');
        $this->load->model('Md_post');
        $this->load->model('Md_product');
        $this->load->library('session');
        $this->load->helper(['url', 'cookie']);
    }

    // -------------------------------------------------------------------------

    private function _signingKey() {
        return 'hh_admin_2026_' . md5(config_item('base_url'));
    }

    private function _makeSign($id, $username) {
        return hash_hmac('sha256', $id . '|' . $username, $this->_signingKey());
    }

    private function _isLoggedIn() {
        $admin = $this->session->userdata('admin');
        if (!empty($admin)) return $admin;

        $raw = get_cookie(self::COOKIE_NAME);
        if (!$raw) return false;

        $decoded = json_decode(base64_decode($raw), true);
        if (empty($decoded['id']) || empty($decoded['username']) || empty($decoded['sign'])) {
            return false;
        }

        $expected = $this->_makeSign($decoded['id'], $decoded['username']);
        if (!hash_equals($expected, $decoded['sign'])) return false;

        $admin = ['id' => (int) $decoded['id'], 'username' => $decoded['username']];
        $this->session->set_userdata('admin', $admin);
        return $admin;
    }

    private function _requireAuth() {
        if (!$this->_isLoggedIn()) {
            redirect(base_url('admin/login'));
        }
    }

    private function _setAuthCookie($admin) {
        $payload = base64_encode(json_encode([
            'id'       => $admin['id'],
            'username' => $admin['username'],
            'sign'     => $this->_makeSign($admin['id'], $admin['username']),
        ]));
        set_cookie(self::COOKIE_NAME, $payload, self::COOKIE_EXPIRY);
    }

    // -------------------------------------------------------------------------

    public function index() {
        redirect($this->_isLoggedIn() ? base_url('admin/dashboard') : base_url('admin/login'));
    }

    public function login() {
        if ($this->_isLoggedIn()) {
            redirect(base_url('admin/dashboard'));
            return;
        }

        $data = ['title' => 'Login', 'msg' => '', 'hideNav' => true];

        if ($this->input->method() === 'post') {
            $username = trim($this->input->post('username', true));
            $password = $this->input->post('password', true);

            $admin = $this->Md_admin->login($username, $password);
            if ($admin) {
                $this->_setAuthCookie($admin);
                redirect(base_url('admin/dashboard'));
                return;
            }
            $data['msg'] = 'Invalid username or password. Please try again.';
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/login', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function dashboard() {
        $this->_requireAuth();
        $admin = $this->_isLoggedIn();

        $db = $this->db;

        $totalPosts     = (int) $db->count_all('posts');
        $publishedPosts = (int) $db->where('status', 1)->count_all_results('posts');
        $draftPosts     = $totalPosts - $publishedPosts;

        $totalProducts     = (int) $db->count_all('products');
        $publishedProducts = (int) $db->where('status', 1)->count_all_results('products');
        $draftProducts     = $totalProducts - $publishedProducts;

        $recentPosts = $db->select('id, title, status, created_at')
                          ->order_by('created_at', 'DESC')
                          ->limit(5)
                          ->get('posts')->result_array();

        $recentProducts = $db->select('id, name, price, status, created_at')
                             ->order_by('created_at', 'DESC')
                             ->limit(5)
                             ->get('products')->result_array();

        $data = [
            'title'            => 'Dashboard',
            'admin'            => $admin,
            'currMenu'         => 'dashboard',
            'hideNav'          => false,
            'totalPosts'       => $totalPosts,
            'publishedPosts'   => $publishedPosts,
            'draftPosts'       => $draftPosts,
            'totalProducts'    => $totalProducts,
            'publishedProducts'=> $publishedProducts,
            'draftProducts'    => $draftProducts,
            'recentPosts'      => $recentPosts,
            'recentProducts'   => $recentProducts,
        ];

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function logout() {
        $this->session->unset_userdata('admin');
        delete_cookie(self::COOKIE_NAME);
        redirect(base_url('admin/login'));
    }

    public function resetPassword() {
        redirect(base_url('admin/login'));
    }

    public function changePassword() {
        $this->_requireAuth();
        redirect(base_url('admin/dashboard'));
    }
}
