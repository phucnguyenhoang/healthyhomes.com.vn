<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Md_product');
    }

    // /san-pham-khac
    public function index() {
        $products = $this->Md_product->getPublished();

        $this->load->view('layout/header', [
            'title'    => 'Sản Phẩm',
            'metadata' => false,
        ]);
        $this->load->view('product/index', ['products' => $products]);
        $this->load->view('layout/footer');
    }

    // /san-pham-khac/<slug>.html
    public function detail($slug) {
        $product = $this->Md_product->getBySlug($slug);
        if (!$product) show_404();

        $mainImage = !empty($product['images']) ? $product['images'][0]['image_url'] : '';

        $bcName = html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8');
        if (mb_strlen($bcName) > 30) {
            $bcName = mb_substr($bcName, 0, 30) . '...';
        }

        $this->load->view('layout/header', [
            'title'        => html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8'),
            'seo_keywords' => $product['seo_keywords'],
            'canonical'    => base_url('san-pham-khac/' . $product['slug'] . '.html'),
            'metadata'     => [
                'thumbnail' => $mainImage ?: base_url('resources/imgs/healthyhomes-logo.png'),
                'desc'      => !empty($product['meta_description'])
                               ? $product['meta_description']
                               : strip_tags($product['description'] ?? ''),
            ],
            'json_ld' => $this->_productSchema($product),
        ]);
        $this->load->view('product/detail', [
            'product' => $product,
            'bcName'  => $bcName,
        ]);
        $this->load->view('layout/footer');
    }

    private function _productSchema($product) {
        $images = array_column($product['images'] ?? [], 'image_url');
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Product',
            'name'        => html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8'),
            'description' => strip_tags($product['description'] ?? ''),
            'image'       => $images,
            'url'         => base_url('san-pham-khac/' . $product['slug'] . '.html'),
            'brand'       => ['@type' => 'Organization', 'name' => 'Healthy Homes'],
            'offers'      => [
                '@type'         => 'Offer',
                'price'         => (string) $product['price'],
                'priceCurrency' => 'VND',
                'availability'  => 'https://schema.org/InStock',
                'url'           => base_url('san-pham-khac/' . $product['slug'] . '.html'),
            ],
        ];
        return '<script type="application/ld+json">'
            . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            . '</script>';
    }
}
