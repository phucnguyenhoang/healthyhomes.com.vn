<?php $version = ENVIRONMENT == 'development' ? '?v=' . rand(1, 1000) . time() : APP_VERSION; ?>

<!DOCTYPE html>
<html lang="km">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>if('ontouchstart'in window||navigator.maxTouchPoints>0){document.documentElement.classList.add('touch-device');}</script>
  <meta property="og:url" content="<?= base_url() ?>">
  <meta property="og:site_name" content="Rainbow System Cambodia">

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
  <title><?php echo (!empty($title) ? htmlspecialchars($title) . ' — Healthy Homes' : 'Rainbow System Cambodia'); ?></title>

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
        <a href="<?php prUrl('request-demo') ?>" class="btn btn-success btn-sm">ស្នើសុំបង្ហាញ</a>
        <a href="https://rainbowsystem.com/support/find-a-distributor" target="_blank" class="btn btn-outline-secondary btn-sm">ស្វែងរកអ្នកចែកចាយ</a>
      </div>
      <ul class="nav-bar">
        <li class="nav-menu">
          <a href="<?php prUrl('products') ?>">ផលិតផល <span class="fas fa-angle-down d-lg-none"></span></a>
          <ul class="sub-menu">
            <li class="nav-menu">
              <a href="<?php prUrl('products') ?>">ប្រព័ន្ធសម្អាតទូទៅ <span class="fas fa-angle-right d-none d-lg-block"></span><span class="fas fa-angle-down d-lg-none"></span></a>
              <ul class="sub-menu">
                <li>
                  <a href="<?php prUrl('products/how-it-works') ?>">របៀបដំណើរការ</a>
                </li>
                <li>
                  <a href="<?php prUrl('products/how-to-buy') ?>">របៀបទិញ</a>
                </li>
                <li>
                  <a href="<?php prUrl('products/tools') ?>">ឧបករណ៍</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="<?php prUrl('other-products') ?>">ផលិតផលផ្សេងទៀត</a>
            </li>
            <li>
              <a href="http://www.rainbowsystem.com/" target="_blank">គេហទំព័ររបស់ USA</a>
            </li>
          </ul>
        </li>
        <li class="nav-menu">
          <a href="<?php prUrl('about/about-us') ?>">អំពី <span class="fas fa-angle-down d-lg-none"></span></a>
          <ul class="sub-menu">
            <li>
              <a href="<?php prUrl('about/about-us') ?>">អំពីយើង</a>
            </li>
            <li>
              <a href="<?php prUrl('about/history') ?>">ប្រវត្តិ</a>
            </li>
            <li>
              <a href="<?php prUrl('about/testimonials') ?>">ការឆ្លើយតបអតិថិជន</a>
            </li>
            <li>
              <a href="<?php prUrl('support/contact-us') ?>">ទំនាក់ទំនងយើង</a>
            </li>
          </ul>
        </li>
        <li class="nav-menu">
          <a href="<?php prUrl('certification/certificates') ?>">វិញ្ញាបនបត្រ <span class="fas fa-angle-down d-lg-none"></span></a>
          <ul class="sub-menu">
            <li>
              <a href="<?php prUrl('certification/certificates') ?>">វិញ្ញាបនបត្រ</a>
            </li>
            <li>
              <a href="<?php prUrl('certification/celebrities') ?>">អ្នកល្បីល្បាញ</a>
            </li>
          </ul>
        </li>
        <li class="nav-menu">
          <a href="<?php prUrl('support') ?>">ការគាំទ្រ <span class="fas fa-angle-down d-lg-none"></span></a>
          <ul class="sub-menu">
            <li>
              <a href="https://rainbowsystem.com/support/find-a-distributor" target="_blank">ស្វែងរកអ្នកចែកចាយ</a>
            </li>
            <li>
              <a href="<?php prUrl('support/buyer-beware') ?>">ការព្រមានអតិថិជន</a>
            </li>
            <li>
              <a href="<?php prUrl('support/videos') ?>">Videos</a>
            </li>
            <li>
              <a href="<?php prUrl('support/user-manual') ?>">មគ្គុទ្ទេសក៍ប្រើប្រាស់</a>
            </li>
            <li>
              <a href="<?php prUrl('support/cleaning-tips') ?>">គន្លឹះសម្អាត</a>
            </li>
            <li>
              <a href="<?php prUrl('support/faq') ?>">សំណួរញឹកញាប់</a>
            </li>
            <li>
              <a href="<?php prUrl('support/datasheet') ?>">ឯកសារយោង</a>
            </li>
            <li>
              <a href="<?php prUrl('support/supplies') ?>">ទិញគ្រឿងបន្ថែម</a>
            </li>
          </ul>
        </li>
        <li class="nav-menu">
          <a href="<?php prUrl('support/contact-us') ?>">ទំនាក់ទំនង</a>
        </li>

        <li class="nav-menu">
            <a href="<?php prUrl('blog') ?>">អត្ថបទ</a>
        </li>

        <li class="nav-button nav-cta-desktop">
          <a href="https://rainbowsystem.com/support/find-a-distributor" target="_blank" class="btn btn-outline-secondary" role="button">ស្វែងរកអ្នកចែកចាយ</a>
        </li>
        <li class="nav-button nav-cta-desktop">
          <a href="<?php prUrl('request-demo') ?>" class="btn btn-success" role="button">ស្នើសុំបង្ហាញ</a>
        </li>
        <li class="nav-menu nav-cta-small-touch">
          <a href="https://rainbowsystem.com/support/find-a-distributor" target="_blank">ស្វែងរកអ្នកចែកចាយ</a>
        </li>
        <li class="nav-menu nav-cta-small-touch">
          <a href="<?php prUrl('request-demo') ?>">ស្នើសុំបង្ហាញ</a>
        </li>
      </ul>
    </div>
  </div>
