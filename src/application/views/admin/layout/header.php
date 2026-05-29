<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <title><?php echo !empty($title) ? htmlspecialchars($title) . ' | Admin' : 'Admin Panel'; ?> — Healthy Homes</title>

    <!-- Font Awesome 5.7.0 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
          crossorigin="anonymous">
    <!-- Bootstrap 4.5.2 -->
    <link href="/resources/css/bootstrap.min.css" rel="stylesheet">
    <?php if (!empty($extra_head)) echo $extra_head; ?>
    <!-- jQuery must be in <head> so inline scripts in views can use $ -->
    <script src="/resources/js/jquery-3.4.1.min.js"></script>

    <style>
        body { background-color: #f4f6f9; }
        .navbar-brand img { height: 30px; }
        .sidebar { min-height: calc(100vh - 56px); background: #343a40; }
        .sidebar .nav-link { color: rgba(255,255,255,.75); padding: .5rem 1rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,.1); border-radius: 4px; }
        .sidebar .nav-link i { width: 20px; margin-right: 6px; }
        .sidebar-heading { color: rgba(255,255,255,.4); font-size: .7rem; text-transform: uppercase; letter-spacing: .1rem; padding: 1rem; }
        .content-wrapper { padding: 1.5rem; min-width: 0; overflow-x: hidden; }
        .page-title { font-size: 1.4rem; font-weight: 600; color: #343a40; margin-bottom: 1.25rem; }
        @media (max-width: 767.98px) {
            .content-wrapper { padding: 1rem; }
            .page-title { font-size: 1.2rem; }
        }
    </style>
</head>
<body<?php if (!empty($hideNav)): ?> style="background:#0f3460;"<?php endif; ?>>

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-1 sticky-top">
    <a class="navbar-brand d-flex align-items-center" href="<?php echo base_url('admin/dashboard'); ?>">
        <i class="fas fa-leaf mr-2"></i>
        <span class="font-weight-bold">Healthy Homes</span>
        <small class="ml-2 text-secondary d-none d-sm-inline">Admin</small>
    </a>

    <?php if (empty($hideNav)): ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNavbar">
        <!-- Mobile nav links (hidden on md+ where sidebar is visible) -->
        <ul class="navbar-nav mr-auto d-md-none">
            <li class="nav-item">
                <a class="nav-link <?php echo (!empty($currMenu) && $currMenu === 'dashboard') ? 'active' : ''; ?>"
                   href="<?php echo base_url('admin/dashboard'); ?>">
                    <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (!empty($currMenu) && $currMenu === 'blogs') ? 'active' : ''; ?>"
                   href="<?php echo base_url('admin/blogs'); ?>">
                    <i class="fas fa-newspaper mr-1"></i> Blog Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (!empty($currMenu) && $currMenu === 'products') ? 'active' : ''; ?>"
                   href="<?php echo base_url('admin/products'); ?>">
                    <i class="fas fa-box-open mr-1"></i> Products
                </a>
            </li>
        </ul>
        <!-- User dropdown -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
                    <i class="fas fa-user-circle mr-1"></i>
                    <?php echo !empty($admin) ? htmlspecialchars($admin['username']) : 'Admin'; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item text-danger" href="<?php echo base_url('admin/logout'); ?>">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <?php endif; ?>
</nav>

<?php if (empty($hideNav)): ?>
<!-- Main layout: sidebar + content -->
<div class="d-flex" style="min-height: calc(100vh - 52px);">

    <!-- Sidebar -->
    <div class="sidebar d-none d-md-block" style="width: 220px; flex-shrink: 0;">
        <div class="sidebar-heading">Navigation</div>
        <ul class="nav flex-column px-2">
            <li class="nav-item">
                <a class="nav-link <?php echo (!empty($currMenu) && $currMenu === 'dashboard') ? 'active' : ''; ?>"
                   href="<?php echo base_url('admin/dashboard'); ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (!empty($currMenu) && $currMenu === 'blogs') ? 'active' : ''; ?>"
                   href="<?php echo base_url('admin/blogs'); ?>">
                    <i class="fas fa-newspaper"></i> Blog Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (!empty($currMenu) && $currMenu === 'products') ? 'active' : ''; ?>"
                   href="<?php echo base_url('admin/products'); ?>">
                    <i class="fas fa-box-open"></i> Products
                </a>
            </li>
        </ul>
    </div>

    <!-- Content area -->
    <div class="flex-grow-1 content-wrapper">
<?php endif; ?>
