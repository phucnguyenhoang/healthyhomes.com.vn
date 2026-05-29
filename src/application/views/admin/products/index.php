<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title mb-0"><i class="fas fa-box-open mr-2 text-secondary"></i>Products</h2>
    <a href="<?php echo base_url('admin/products/create'); ?>" class="btn btn-dark btn-sm">
        <i class="fas fa-plus mr-1"></i> New Product
    </a>
</div>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show">
    <i class="fas fa-check-circle mr-1"></i> <?php echo $this->session->flashdata('success'); ?>
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($products)): ?>
        <div class="text-center py-5 text-muted">
            <i class="fas fa-box-open fa-3x mb-3" style="opacity:.3;"></i>
            <p>No products yet. <a href="<?php echo base_url('admin/products/create'); ?>">Create your first product.</a></p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="thead-light">
                    <tr>
                        <th class="d-none d-sm-table-cell" style="width:50px">Order</th>
                        <th style="width:60px">Image</th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell">Price</th>
                        <th class="d-none d-sm-table-cell">Status</th>
                        <th class="text-center" style="width:110px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $p): ?>
                <?php
                    $imgs = $this->Md_product->getImages($p['id']);
                    $mainImg = !empty($imgs) ? $imgs[0]['image_url'] : '';
                ?>
                <tr>
                    <td class="d-none d-sm-table-cell text-center text-muted small">
                        <?php echo $p['display_order']; ?>
                    </td>
                    <td>
                        <?php if ($mainImg): ?>
                        <img src="<?php echo $mainImg; ?>" class="rounded" style="width:48px;height:48px;object-fit:cover;" alt="">
                        <?php else: ?>
                        <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                            <i class="fas fa-image text-muted"></i>
                        </div>
                        <?php endif; ?>
                    </td>
                    <td style="max-width:0; width:50%;">
                        <div class="text-truncate font-weight-medium">
                            <?php echo htmlspecialchars($p['name']); ?>
                        </div>
                        <small class="text-muted d-none d-sm-block text-truncate">
                            /san-pham-khac/<?php echo $p['slug']; ?>.html
                        </small>
                        <!-- Price + status inline — mobile only -->
                        <div class="d-sm-none mt-1">
                            <span class="small text-success font-weight-bold mr-1">
                                <?php echo $this->Md_product->formatPrice($p['price']); ?>
                            </span>
                            <?php if ($p['status'] == 1): ?>
                                <span class="badge badge-success">Published</span>
                            <?php else: ?>
                                <span class="badge badge-warning text-dark">Draft</span>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td class="d-none d-sm-table-cell text-nowrap">
                        <?php echo $this->Md_product->formatPrice($p['price']); ?>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <?php if ($p['status'] == 1): ?>
                            <span class="badge badge-success">Published</span>
                        <?php else: ?>
                            <span class="badge badge-warning text-dark">Draft</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center text-nowrap">
                        <a href="<?php echo base_url('admin/products/edit/' . $p['id']); ?>"
                           class="btn btn-outline-primary btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <?php if ($p['status'] == 1): ?>
                        <a href="<?php echo base_url('san-pham-khac/' . $p['slug'] . '.html'); ?>"
                           class="btn btn-outline-secondary btn-sm d-none d-sm-inline-block" target="_blank" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <?php endif; ?>
                        <a href="<?php echo base_url('admin/products/delete/' . $p['id']); ?>"
                           class="btn btn-outline-danger btn-sm" title="Delete"
                           onclick="return confirm('Delete this product and all its images?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php if (!empty($pagination) && $pagination['total'] > 1): ?>
<nav class="mt-4">
    <ul class="pagination pagination-sm justify-content-center">
        <?php if ($pagination['current'] > 1): ?>
        <li class="page-item">
            <a class="page-link" href="?page=<?php echo $pagination['current'] - 1; ?>"><i class="fas fa-chevron-left"></i></a>
        </li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $pagination['total']; $i++): ?>
        <li class="page-item <?php echo $i == $pagination['current'] ? 'active' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
        <?php endfor; ?>
        <?php if ($pagination['current'] < $pagination['total']): ?>
        <li class="page-item">
            <a class="page-link" href="?page=<?php echo $pagination['current'] + 1; ?>"><i class="fas fa-chevron-right"></i></a>
        </li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>
