<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    const COOKIE_NAME   = 'hh_admin_auth';
    const UPLOAD_DIR    = 'resources/imgs/products/';
    const MAX_IMG_WIDTH = 1024;

    public function __construct() {
        parent::__construct();
        $this->load->model('Md_product');
        $this->load->library('session');
        $this->load->helper(['url', 'cookie']);
    }

    // -------------------------------------------------------------------------
    // Auth helpers
    // -------------------------------------------------------------------------

    private function _isLoggedIn() {
        $admin = $this->session->userdata('admin');
        if (!empty($admin)) return $admin;

        $raw = get_cookie(self::COOKIE_NAME);
        if (!$raw) return false;

        $decoded = json_decode(base64_decode($raw), true);
        if (empty($decoded['id']) || empty($decoded['username']) || empty($decoded['sign'])) return false;

        $key      = 'hh_admin_2026_' . md5(config_item('base_url'));
        $expected = hash_hmac('sha256', $decoded['id'] . '|' . $decoded['username'], $key);
        if (!hash_equals($expected, $decoded['sign'])) return false;

        $admin = ['id' => (int) $decoded['id'], 'username' => $decoded['username']];
        $this->session->set_userdata('admin', $admin);
        return $admin;
    }

    private function _requireAuth() {
        if (!$this->_isLoggedIn()) redirect(base_url('admin/login'));
    }

    // -------------------------------------------------------------------------
    // Admin CRUD
    // -------------------------------------------------------------------------

    public function index() {
        $this->_requireAuth();

        $total   = $this->Md_product->countAll();
        $totPage = (int) ceil($total / ITEM_PER_PAGE);
        $currPage = max(1, (int) $this->input->get('page'));
        if ($totPage > 0 && $currPage > $totPage) show_404();

        $data = [
            'title'    => 'Products',
            'admin'    => $this->_isLoggedIn(),
            'currMenu' => 'products',
            'products' => $this->Md_product->getAll($currPage),
            'pagination' => ['total' => $totPage, 'current' => $currPage],
        ];

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/products/index', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function create() {
        $this->_requireAuth();

        $data = [
            'title'      => 'New Product',
            'admin'      => $this->_isLoggedIn(),
            'currMenu'   => 'products',
            'product'    => null,
            'error'      => '',
            'extra_head' => '<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">',
            'extra_js'   => '<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>',
        ];

        if ($this->input->method() === 'post') {
            $input = $this->_collectInput();
            $error = $this->_validate($input);

            if (!$error) {
                $imageUrls = (array) $this->input->post('image_urls');
                $imageUrls = array_filter(array_map('trim', $imageUrls));
                $this->Md_product->add($input, array_values($imageUrls));
                $this->session->set_flashdata('success', 'Product created successfully.');
                redirect(base_url('admin/products'));
                return;
            }
            $data['error']   = $error;
            $data['product'] = $input;
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/products/form', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function edit($id) {
        $this->_requireAuth();
        $product = $this->Md_product->getById($id);
        if (!$product) show_404();

        $data = [
            'title'      => 'Edit Product',
            'admin'      => $this->_isLoggedIn(),
            'currMenu'   => 'products',
            'product'    => $product,
            'error'      => '',
            'extra_head' => '<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">',
            'extra_js'   => '<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>',
        ];

        if ($this->input->method() === 'post') {
            $input = $this->_collectInput();
            $error = $this->_validate($input);

            if (!$error) {
                $newUrls = (array) $this->input->post('image_urls');
                $newUrls = array_values(array_filter(array_map('trim', $newUrls)));
                $this->Md_product->update($id, $input, $newUrls);
                $this->session->set_flashdata('success', 'Product updated successfully.');
                redirect(base_url('admin/products/edit/' . $id));
                return;
            }
            $data['error']   = $error;
            $data['product'] = array_merge($product, $input);
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/products/form', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function delete($id) {
        $this->_requireAuth();
        $this->Md_product->delete($id);
        $this->session->set_flashdata('success', 'Product deleted.');
        redirect(base_url('admin/products'));
    }

    // -------------------------------------------------------------------------
    // Image upload (AJAX)
    // -------------------------------------------------------------------------

    public function uploadImage() {
        if ($this->input->method() !== 'post') { http_response_code(405); return; }
        $this->_requireAuth();
        header('Content-Type: application/json');

        if (empty($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => 'No file uploaded.']);
            return;
        }

        $file    = $_FILES['file'];
        $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowed)) {
            echo json_encode(['success' => false, 'message' => 'Invalid file type.']);
            return;
        }

        $ext      = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = 'prd_' . uniqid() . '.' . $ext;
        $destDir  = FCPATH . self::UPLOAD_DIR;
        $destPath = $destDir . $filename;
        if (!is_dir($destDir)) mkdir($destDir, 0755, true);

        $imgInfo = getimagesize($file['tmp_name']);
        if ($imgInfo && $imgInfo[0] > self::MAX_IMG_WIDTH) {
            $this->_resizeImage($file['tmp_name'], $destPath, $imgInfo, self::MAX_IMG_WIDTH);
        } else {
            move_uploaded_file($file['tmp_name'], $destPath);
        }

        echo json_encode(['success' => true, 'url' => base_url(self::UPLOAD_DIR . $filename)]);
    }

    public function deleteImage($id) {
        $this->_requireAuth();
        header('Content-Type: application/json');

        $img = $this->Md_product->deleteImage($id);
        if ($img) {
            $filePath = FCPATH . ltrim(parse_url($img['image_url'], PHP_URL_PATH), '/');
            if (file_exists($filePath)) @unlink($filePath);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Image not found.']);
        }
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function _collectInput() {
        return [
            'name'             => trim($this->input->post('name', true)),
            'price'            => (int) str_replace(['.', ','], '', $this->input->post('price', true)),
            'description'      => $this->input->post('description'),
            'display_order'    => (int) $this->input->post('display_order'),
            'status'           => (int) $this->input->post('status'),
            'seo_keywords'     => trim($this->input->post('seo_keywords', true)),
            'meta_description' => trim($this->input->post('meta_description', true)),
        ];
    }

    private function _validate($input) {
        if (empty($input['name'])) return 'Product name is required.';
        if (strlen($input['name']) > 500) return 'Product name is too long (max 500 chars).';
        return '';
    }

    private function _resizeImage($src, $dest, $imgInfo, $maxWidth) {
        list($origW, $origH, $type) = $imgInfo;
        $newW   = $maxWidth;
        $newH   = (int) ($origH * ($maxWidth / $origW));
        $canvas = imagecreatetruecolor($newW, $newH);

        switch ($type) {
            case IMAGETYPE_JPEG: $source = imagecreatefromjpeg($src); break;
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($src);
                imagealphablending($canvas, false);
                imagesavealpha($canvas, true);
                imagefilledrectangle($canvas, 0, 0, $newW, $newH,
                    imagecolorallocatealpha($canvas, 0, 0, 0, 127));
                break;
            case IMAGETYPE_GIF:  $source = imagecreatefromgif($src); break;
            case IMAGETYPE_WEBP: $source = imagecreatefromwebp($src); break;
            default: move_uploaded_file($src, $dest); return;
        }

        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
        imagedestroy($source);

        switch ($type) {
            case IMAGETYPE_JPEG: imagejpeg($canvas, $dest, 90); break;
            case IMAGETYPE_PNG:  imagepng($canvas, $dest, 7);   break;
            case IMAGETYPE_GIF:  imagegif($canvas, $dest);      break;
            case IMAGETYPE_WEBP: imagewebp($canvas, $dest, 90); break;
        }
        imagedestroy($canvas);
    }
}
