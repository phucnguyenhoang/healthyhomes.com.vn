<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Md_post');
    }

    // /bai-viet
    public function index() {
        $total    = $this->Md_post->countPublished();
        $totPage  = (int) ceil($total / Md_post::PER_PAGE);
        $currPage = max(1, (int) $this->input->get('page'));
        if ($currPage < 1) $currPage = 1;
        if ($totPage > 0 && $currPage > $totPage) show_404();

        $pagination = $total > Md_post::PER_PAGE
            ? ['total' => $totPage, 'current' => $currPage]
            : [];

        $data = [
            'title'    => 'Bài Viết',
            'posts'    => $this->Md_post->getPublished($currPage),
            'pagination' => $pagination,
            'metadata' => false,
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('post/index', $data);
        $this->load->view('layout/footer');
    }

    // /bai-viet/<slug>.html
    public function detail($slug) {
        $post = $this->Md_post->getBySlug($slug);
        if (!$post) show_404();

        $tags = $this->Md_post->parseTags($post['tags']);

        $headerData = [
            'title'       => html_entity_decode($post['title'], ENT_QUOTES, 'UTF-8'),
            'seo_keywords'=> $post['seo_keywords'],
            'canonical'   => base_url('bai-viet/' . $post['slug'] . '.html'),
            'metadata'    => [
                'thumbnail' => !empty($post['thumbnail']) ? $post['thumbnail'] : base_url('resources/imgs/healthyhomes-logo.png'),
                'desc'      => !empty($post['meta_description']) ? $post['meta_description'] : strip_tags($post['description']),
            ],
            'json_ld'     => $this->_articleSchema($post),
        ];

        $this->load->view('layout/header', $headerData);
        $this->load->view('post/detail', ['post' => $post, 'tags' => $tags]);
        $this->load->view('layout/footer');
    }

    // /bai-viet/<tag>
    public function byTag($tag) {
        $tag      = urldecode($tag);
        $total    = $this->Md_post->countByTag($tag);
        $totPage  = (int) ceil($total / Md_post::PER_PAGE);
        $currPage = max(1, (int) $this->input->get('page'));
        if ($totPage > 0 && $currPage > $totPage) show_404();

        $pagination = $total > Md_post::PER_PAGE
            ? ['total' => $totPage, 'current' => $currPage]
            : [];

        $data = [
            'title'      => 'Chủ đề: ' . htmlspecialchars($tag),
            'tag'        => $tag,
            'posts'      => $this->Md_post->getByTag($tag, $currPage),
            'pagination' => $pagination,
            'metadata'   => false,
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('post/tag', $data);
        $this->load->view('layout/footer');
    }

    private function _articleSchema($post) {
        $schema = [
            '@context'         => 'https://schema.org',
            '@type'            => 'Article',
            'headline'         => html_entity_decode($post['title'], ENT_QUOTES, 'UTF-8'),
            'description'      => strip_tags($post['description']),
            'datePublished'    => date('c', strtotime($post['created_at'])),
            'dateModified'     => date('c', strtotime($post['updated_at'] ?? $post['created_at'])),
            'image'            => !empty($post['thumbnail']) ? $post['thumbnail'] : '',
            'publisher' => [
                '@type' => 'Organization',
                'name'  => 'Healthy Homes',
                'logo'  => ['@type' => 'ImageObject', 'url' => base_url('resources/imgs/healthyhomes-logo.png')],
            ],
        ];
        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
    }
}
