<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title mb-0">
        <i class="fas fa-tachometer-alt mr-2 text-secondary"></i>Dashboard
    </h2>
    <span class="text-muted small">
        Welcome back, <strong><?php echo htmlspecialchars($admin['username']); ?></strong>
    </span>
</div>

<!-- Quick actions -->
<div class="mb-4">
    <a href="<?php echo base_url('admin/blogs/create'); ?>" class="btn btn-dark btn-sm mr-2">
        <i class="fas fa-plus mr-1"></i> New Blog Post
    </a>
    <a href="<?php echo base_url('admin/products/create'); ?>" class="btn btn-outline-dark btn-sm">
        <i class="fas fa-plus mr-1"></i> Add Product
    </a>
</div>

<!-- Stat cards -->
<div class="row mb-4">

    <!-- Blog Posts -->
    <div class="col-sm-6 col-xl-3 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mr-3 flex-shrink-0"
                     style="width:48px;height:48px;">
                    <i class="fas fa-newspaper text-white"></i>
                </div>
                <div>
                    <div class="h4 mb-0 font-weight-bold"><?php echo $totalPosts; ?></div>
                    <div class="small text-muted">Total Posts</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-success d-flex align-items-center justify-content-center mr-3 flex-shrink-0"
                     style="width:48px;height:48px;">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div>
                    <div class="h4 mb-0 font-weight-bold"><?php echo $publishedPosts; ?></div>
                    <div class="small text-muted">Published Posts</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->
    <div class="col-sm-6 col-xl-3 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center mr-3 flex-shrink-0"
                     style="width:48px;height:48px;">
                    <i class="fas fa-box-open text-white"></i>
                </div>
                <div>
                    <div class="h4 mb-0 font-weight-bold"><?php echo $totalProducts; ?></div>
                    <div class="small text-muted">Total Products</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-success d-flex align-items-center justify-content-center mr-3 flex-shrink-0"
                     style="width:48px;height:48px;">
                    <i class="fas fa-store text-white"></i>
                </div>
                <div>
                    <div class="h4 mb-0 font-weight-bold"><?php echo $publishedProducts; ?></div>
                    <div class="small text-muted">Published Products</div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Recent activity -->
<div class="row">

    <!-- Recent posts -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="font-weight-bold">
                    <i class="fas fa-newspaper mr-1 text-secondary"></i> Recent Posts
                </span>
                <a href="<?php echo base_url('admin/blogs'); ?>" class="btn btn-outline-secondary btn-sm">
                    View all
                </a>
            </div>
            <div class="card-body p-0">
                <?php if (empty($recentPosts)): ?>
                <div class="text-center py-4 text-muted small">No posts yet.</div>
                <?php else: ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($recentPosts as $p): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-3 py-2">
                        <div class="text-truncate mr-2" style="max-width:260px;">
                            <a href="<?php echo base_url('admin/blogs/edit/' . $p['id']); ?>"
                               class="text-dark text-decoration-none font-weight-medium small">
                                <?php echo htmlspecialchars(html_entity_decode($p['title'], ENT_QUOTES, 'UTF-8')); ?>
                            </a>
                            <div class="text-muted" style="font-size:.75rem;">
                                <?php echo date('d/m/Y', strtotime($p['created_at'])); ?>
                            </div>
                        </div>
                        <?php if ($p['status'] == 1): ?>
                        <span class="badge badge-success flex-shrink-0">Published</span>
                        <?php else: ?>
                        <span class="badge badge-warning text-dark flex-shrink-0">Draft</span>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            <div class="card-footer bg-white text-right">
                <a href="<?php echo base_url('admin/blogs/create'); ?>" class="btn btn-dark btn-sm">
                    <i class="fas fa-plus mr-1"></i> New Post
                </a>
            </div>
        </div>
    </div>

    <!-- Recent products -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="font-weight-bold">
                    <i class="fas fa-box-open mr-1 text-secondary"></i> Recent Products
                </span>
                <a href="<?php echo base_url('admin/products'); ?>" class="btn btn-outline-secondary btn-sm">
                    View all
                </a>
            </div>
            <div class="card-body p-0">
                <?php if (empty($recentProducts)): ?>
                <div class="text-center py-4 text-muted small">No products yet.</div>
                <?php else: ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($recentProducts as $p): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-3 py-2">
                        <div class="text-truncate mr-2" style="max-width:260px;">
                            <a href="<?php echo base_url('admin/products/edit/' . $p['id']); ?>"
                               class="text-dark text-decoration-none font-weight-medium small">
                                <?php echo htmlspecialchars(html_entity_decode($p['name'], ENT_QUOTES, 'UTF-8')); ?>
                            </a>
                            <div class="text-muted" style="font-size:.75rem;">
                                <?php echo $p['price'] > 0 ? number_format((int)$p['price'], 0, ',', '.') . ' đ' : '—'; ?>
                                &middot; <?php echo date('d/m/Y', strtotime($p['created_at'])); ?>
                            </div>
                        </div>
                        <?php if ($p['status'] == 1): ?>
                        <span class="badge badge-success flex-shrink-0">Published</span>
                        <?php else: ?>
                        <span class="badge badge-warning text-dark flex-shrink-0">Draft</span>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            <div class="card-footer bg-white text-right">
                <a href="<?php echo base_url('admin/products/create'); ?>" class="btn btn-dark btn-sm">
                    <i class="fas fa-plus mr-1"></i> Add Product
                </a>
            </div>
        </div>
    </div>

</div>
