<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {

    const COOKIE_NAME   = 'hh_admin_auth';
    const UPLOAD_DIR    = 'resources/imgs/posts/';
    const MAX_IMG_WIDTH = 1024;

    public function __construct() {
        parent::__construct();
        $this->load->model('Md_post');
        $this->load->library('session');
        $this->load->helper(['url', 'cookie']);
    }

    // -------------------------------------------------------------------------
    // Auth helpers (mirrors Admin controller logic)
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
        $admin = $this->_isLoggedIn();

        $total    = $this->Md_post->countAll();
        $totPage  = (int) ceil($total / ITEM_PER_PAGE);
        $currPage = max(1, (int) $this->input->get('page'));
        if ($totPage > 0 && $currPage > $totPage) show_404();

        $data = [
            'title'    => 'Blog Posts',
            'admin'    => $admin,
            'currMenu' => 'blogs',
            'posts'    => $this->Md_post->getAll($currPage),
            'pagination' => ['total' => $totPage, 'current' => $currPage],
        ];

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/blogs/index', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function create() {
        $this->_requireAuth();
        $admin = $this->_isLoggedIn();

        $data = [
            'title'     => 'New Post',
            'admin'     => $admin,
            'currMenu'  => 'blogs',
            'post'      => null,
            'error'     => '',
            'extra_head' => '<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">',
            'extra_js'  => $this->_summernoteJs(base_url('admin/blogs/upload-image')),
        ];

        if ($this->input->method() === 'post') {
            $input = $this->_collectInput();
            $error = $this->_validate($input);

            if (!$error) {
                $thumb = $this->_handleThumbnailUpload();
                if ($thumb !== false) $input['thumbnail'] = $thumb;

                $this->Md_post->add($input);
                $this->session->set_flashdata('success', 'Post created successfully.');
                redirect(base_url('admin/blogs'));
                return;
            }
            $data['error'] = $error;
            $data['post']  = $input;
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/blogs/form', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function edit($id) {
        $this->_requireAuth();
        $admin = $this->_isLoggedIn();
        $post  = $this->Md_post->getById($id);
        if (!$post) show_404();

        $data = [
            'title'     => 'Edit Post',
            'admin'     => $admin,
            'currMenu'  => 'blogs',
            'post'      => $post,
            'error'     => '',
            'extra_head' => '<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">',
            'extra_js'  => $this->_summernoteJs(base_url('admin/blogs/upload-image')),
        ];

        if ($this->input->method() === 'post') {
            $input = $this->_collectInput();
            $error = $this->_validate($input);

            if (!$error) {
                $thumb = $this->_handleThumbnailUpload();
                if ($thumb !== false) {
                    $input['thumbnail'] = $thumb;
                } else {
                    $input['thumbnail'] = $post['thumbnail'];
                }

                $this->Md_post->update($id, $input);
                $this->session->set_flashdata('success', 'Post updated successfully.');
                redirect(base_url('admin/blogs'));
                return;
            }
            $data['error'] = $error;
            $data['post']  = array_merge($post, $input);
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/blogs/form', $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function delete($id) {
        $this->_requireAuth();
        $post = $this->Md_post->getById($id);
        if ($post) {
            $this->Md_post->delete($id);
            $this->session->set_flashdata('success', 'Post deleted.');
        }
        redirect(base_url('admin/blogs'));
    }

    public function view($id) {
        $this->_requireAuth();
        $post = $this->Md_post->getById($id);
        if (!$post) show_404();
        redirect(base_url('bai-viet/' . $post['slug'] . '.html'));
    }

    // -------------------------------------------------------------------------
    // Summernote image upload (AJAX)
    // -------------------------------------------------------------------------

    public function uploadImage() {
        if ($this->input->method() !== 'post') {
            http_response_code(405);
            return;
        }
        $this->_requireAuth();

        header('Content-Type: application/json');

        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
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
        $filename = 'img_' . uniqid() . '.' . $ext;
        $destDir  = FCPATH . self::UPLOAD_DIR;
        $destPath = $destDir . $filename;

        if (!is_dir($destDir)) mkdir($destDir, 0755, true);

        $imgInfo = getimagesize($file['tmp_name']);
        if ($imgInfo && $imgInfo[0] > self::MAX_IMG_WIDTH) {
            $this->_resizeImage($file['tmp_name'], $destPath, $imgInfo, self::MAX_IMG_WIDTH);
        } else {
            move_uploaded_file($file['tmp_name'], $destPath);
        }

        echo json_encode([
            'success'  => true,
            'url'      => base_url(self::UPLOAD_DIR . $filename),
            'filename' => $filename,
        ]);
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function _collectInput() {
        return [
            'title'            => trim($this->input->post('title', true)),
            'description'      => trim($this->input->post('description', true)),
            'content'          => $this->input->post('content'),   // raw HTML from Summernote
            'tags'             => trim($this->input->post('tags', true)),
            'status'           => (int) $this->input->post('status'),
            'seo_keywords'     => trim($this->input->post('seo_keywords', true)),
            'meta_description' => trim($this->input->post('meta_description', true)),
        ];
    }

    private function _validate($input) {
        if (empty($input['title'])) return 'Title is required.';
        if (strlen($input['title']) > 500) return 'Title is too long (max 500 chars).';
        return '';
    }

    private function _handleThumbnailUpload() {
        if (empty($_FILES['thumbnail']['name'])) return false;
        $file    = $_FILES['thumbnail'];
        if ($file['error'] !== UPLOAD_ERR_OK) return false;

        $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowed)) return false;

        $ext      = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = 'thumb_' . uniqid() . '.' . $ext;
        $destDir  = FCPATH . self::UPLOAD_DIR;
        $destPath = $destDir . $filename;

        if (!is_dir($destDir)) mkdir($destDir, 0755, true);

        $imgInfo = getimagesize($file['tmp_name']);
        if ($imgInfo && $imgInfo[0] > self::MAX_IMG_WIDTH) {
            $this->_resizeImage($file['tmp_name'], $destPath, $imgInfo, self::MAX_IMG_WIDTH);
        } else {
            move_uploaded_file($file['tmp_name'], $destPath);
        }

        return base_url(self::UPLOAD_DIR . $filename);
    }

    private function _resizeImage($src, $dest, $imgInfo, $maxWidth) {
        list($origW, $origH, $type) = $imgInfo;
        $ratio  = $maxWidth / $origW;
        $newW   = $maxWidth;
        $newH   = (int) ($origH * $ratio);
        $canvas = imagecreatetruecolor($newW, $newH);

        switch ($type) {
            case IMAGETYPE_JPEG:
                $source = imagecreatefromjpeg($src);
                break;
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($src);
                imagealphablending($canvas, false);
                imagesavealpha($canvas, true);
                imagefilledrectangle($canvas, 0, 0, $newW, $newH,
                    imagecolorallocatealpha($canvas, 0, 0, 0, 127));
                break;
            case IMAGETYPE_GIF:
                $source = imagecreatefromgif($src);
                break;
            case IMAGETYPE_WEBP:
                $source = imagecreatefromwebp($src);
                break;
            default:
                move_uploaded_file($src, $dest);
                return;
        }

        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
        imagedestroy($source);

        switch ($type) {
            case IMAGETYPE_JPEG: imagejpeg($canvas, $dest, 90);   break;
            case IMAGETYPE_PNG:  imagepng($canvas, $dest, 7);     break;
            case IMAGETYPE_GIF:  imagegif($canvas, $dest);        break;
            case IMAGETYPE_WEBP: imagewebp($canvas, $dest, 90);   break;
        }
        imagedestroy($canvas);
    }

    private function _summernoteJs($uploadUrl) {
        return <<<JS
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
$(document).ready(function () {
    $('#content').summernote({
        height: 420,
        placeholder: 'Write your post content here...',
        toolbar: [
            ['style',  ['style']],
            ['font',   ['bold','italic','underline','strikethrough','clear']],
            ['para',   ['ul','ol','paragraph']],
            ['insert', ['link','picture','video','hr']],
            ['table',  ['table']],
            ['view',   ['fullscreen','codeview']]
        ],
        callbacks: {
            onImageUpload: function (files) {
                var fd = new FormData();
                fd.append('file', files[0]);
                $.ajax({
                    url: '$uploadUrl',
                    type: 'POST',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        var r = typeof res === 'string' ? JSON.parse(res) : res;
                        if (r.success) {
                            $('#content').summernote('insertImage', r.url, r.filename);
                        } else {
                            alert('Upload failed: ' + (r.message || 'Unknown error'));
                        }
                    },
                    error: function () { alert('Image upload failed.'); }
                });
            }
        }
    });
});
</script>
JS;
    }
}
