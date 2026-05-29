<?php $version = ENVIRONMENT == 'development' ? '?v=' . rand(1, 1000) . time() : APP_VERSION; ?>

<!DOCTYPE html>
<html lang="vn">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>if('ontouchstart'in window||navigator.maxTouchPoints>0){document.documentElement.classList.add('touch-device');}</script>
  <meta property="og:url" content="<?= base_url() ?>">
  <meta property="og:site_name" content="Rainbow System Việt Nam">

  <?php if (!empty($metadata)) : ?>
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?= htmlspecialchars($title ?? '') ?>">
    <meta property="og:image" itemprop="image primaryImageOfPage" content="<?= $metadata['thumbnail']; ?>">
    <meta property="og:description" content="<?= htmlspecialchars($metadata['desc']) ?>">
    <meta name="description" content="<?= htmlspecialchars($metadata['desc']) ?>">
  <?php else : ?>
    <meta property="og:type" content="website">
    <meta property="og:image" itemprop="image primaryImageOfPage" content="<?php prImg('healthyhomes-logo.png') ?>">
  <?php endif; ?>

  <?php if (!empty($seo_keywords)): ?>
  <meta name="keywords" content="<?= htmlspecialchars($seo_keywords) ?>">
  <?php endif; ?>
  <?php if (!empty($canonical)): ?>
  <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
  <?php endif; ?>

  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel='shortcut icon' type='image/x-icon' href='/favicon.ico'>
  <title><?php echo (!empty($title) ? htmlspecialchars($title) . ' — Healthy Homes' : 'Rainbow System Việt Nam'); ?></title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link href="/resources/css/bootstrap.min.css" rel="stylesheet">
  <link href="/resources/css/layout.css?v=<?= $version ?>" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <!-- Google reCAPTCHA v2 -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <?php if (!empty($json_ld)) echo $json_ld; ?>
</head>

<body>
  <div class="header">
    <div class="nav">
      <a class="main-logo" href="/">
        <img alt="Main logo" src="<?php prImg('healthyhomes-logo.png') ?>">
      </a>
      <button type="button" class="btn btn-outline-primary float-right" id="btnMenu"><span class="fas fa-bars"></span></button>
      <div class="nav-touch-cta">
        <a href="<?php prUrl('yeu-cau-dung-thu-tai-nha') ?>" class="btn btn-success btn-sm">Yêu Cầu Dùng Thử</a>
        <a href="https://rainbowsystem.com/support/find-a-distributor" target="_blank" class="btn btn-outline-secondary btn-sm">Tìm Nhà Phân Phối</a>
      </div>
      <ul class="nav-bar">
        <li class="nav-menu">
          <a href="<?php prUrl('san-pham') ?>">Sản Phẩm <span class="fas fa-angle-down d-lg-none"></span></a>
          <ul class="sub-menu">
            <li class="nav-menu">
              <a href="<?php prUrl('san-pham') ?>">Hệ Thống Làm Sạch Tổng Hợp <span class="fas fa-angle-right d-none d-lg-block"></span><span class="fas fa-angle-down d-lg-none"></span></a>
              <ul class="sub-menu">
                <li>
                  <a href="<?php prUrl('san-pham/cach-thuc-van-hanh') ?>">Cách Thức Vận Hành</a>
                </li>
                <li>
                  <a href="<?php prUrl('san-pham/cach-thuc-mua-hang') ?>">Cách Thức Mua Hàng</a>
                </li>
                <li>
                  <a href="<?php prUrl('san-pham/dung-cu') ?>">Dụng Cụ</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="<?php prUrl('san-pham-khac') ?>">Các Sản Phẩm Khác</a>
            </li>
            <li>
              <a href="http://www.rainbowsystem.com/">Website Trụ Sở USA</a>
            </li>
          </ul>
        </li>
        <li class="nav-menu">
          <a href="<?php prUrl('gioi-thieu/gioi-thieu-ve-chung-toi') ?>">Giới Thiệu <span class="fas fa-angle-down d-lg-none"></span></a>
          <ul class="sub-menu">
            <li>
              <a href="<?php prUrl('gioi-thieu/gioi-thieu-ve-chung-toi') ?>">Giới Thiệu Về Chúng Tôi</a>
            </li>
            <li>
              <a href="<?php prUrl('gioi-thieu/lich-su-thanh-lap') ?>">Lịch Sử Thành Lập</a>
            </li>
            <li>
              <a href="<?php prUrl('gioi-thieu/chung-thuc-tu-khach-hang') ?>">Chứng Thực Từ Khách Hàng</a>
            </li>
            <li>
              <a href="<?php prUrl('ho-tro/lien-he-chung-toi') ?>">Liên Hệ Chúng Tôi</a>
            </li>
          </ul>
        </li>
        <li class="nav-menu">
          <a href="<?php prUrl('chung-nhan/giay-chung-nhan') ?>">Chứng Nhận <span class="fas fa-angle-down d-lg-none"></span></a>
          <ul class="sub-menu">
            <li>
              <a href="<?php prUrl('chung-nhan/giay-chung-nhan') ?>">Giấy Chứng Nhận</a>
            </li>
            <li>
              <a href="<?php prUrl('chung-nhan/nguoi-noi-tieng') ?>">Người Nổi Tiếng</a>
            </li>
          </ul>
        </li>
        <li class="nav-menu">
          <a href="<?php prUrl('ho-tro') ?>">Hỗ Trợ <span class="fas fa-angle-down d-lg-none"></span></a>
          <ul class="sub-menu">
            <li>
              <a href="https://rainbowsystem.com/support/find-a-distributor" target="_blank">Tìm Nhà Phân Phối</a>
            </li>
            <li>
              <a href="<?php prUrl('ho-tro/khach-hang-chu-y') ?>">Khách Hàng Chú Ý</a>
            </li>
            <li>
              <a href="<?php prUrl('ho-tro/videos') ?>">Videos</a>
            </li>
            <li>
              <a href="<?php prUrl('ho-tro/huong-dan-su-dung') ?>">Hướng Dẫn Sử Dụng</a>
            </li>
            <li>
              <a href="<?php prUrl('ho-tro/nhung-meo-lam-sach') ?>">Những Mẹo Làm Sạch</a>
            </li>
            <li>
              <a href="<?php prUrl('ho-tro/nhung-cau-hoi-thuong-gap') ?>">Những Câu Hỏi Thường Gặp</a>
            </li>
            <li>
              <a href="<?php prUrl('ho-tro/du-lieu-tham-khao') ?>">Dữ Liệu Tham Khảo</a>
            </li>
            <li>
              <a href="<?php prUrl('ho-tro/dat-mua-phu-kien') ?>">Đặt Mua Phụ Kiện</a>
            </li>
          </ul>
        </li>
        <li class="nav-menu">
          <a href="<?php prUrl('ho-tro/lien-he-chung-toi') ?>">Liên Hệ <span class="d-lg-none">Chúng Tôi</span></a>
        </li>

        <li class="nav-menu">
            <a href="<?php prUrl('bai-viet') ?>">Bài Viết</a>
        </li>

        <li class="nav-button nav-cta-desktop">
          <a href="https://rainbowsystem.com/support/find-a-distributor" target="_blank" class="btn btn-outline-secondary" role="button">Tìm Nhà Phân Phối</a>
        </li>
        <li class="nav-button nav-cta-desktop">
          <a href="<?php prUrl('yeu-cau-dung-thu-tai-nha') ?>" class="btn btn-success" role="button">Yêu Cầu Dùng Thử</a>
        </li>
        <li class="nav-menu nav-cta-small-touch">
          <a href="https://rainbowsystem.com/support/find-a-distributor" target="_blank">Tìm Nhà Phân Phối</a>
        </li>
        <li class="nav-menu nav-cta-small-touch">
          <a href="<?php prUrl('yeu-cau-dung-thu-tai-nha') ?>">Yêu Cầu Dùng Thử</a>
        </li>
      </ul>
    </div>
  </div>