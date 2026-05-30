<style>
.product-card { transition: transform .18s, box-shadow .18s; }
.product-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,.12) !important; }
.product-card .card-img-top { height: 220px; object-fit: cover; }
.product-price { font-size: 1.1rem; font-weight: 700; color: #28a745; }
</style>

<div class="pan-title p-pan-title">
    <div class="container">
        <h1 class="float-left">ផលិតផល</h1>
        <p class="float-right d-none d-md-block">
            <a href="/"><span>Rainbow® Cleaning System</span></a>
            <span>/</span>
            <span>ផលិតផល</span>
        </p>
    </div>
</div>

<div class="container content-padding">

    <?php if (empty($products)): ?>
    <div class="text-center py-5 text-muted">
        <i class="fas fa-box-open fa-3x mb-3" style="opacity:.3;"></i>
        <p>មិនទាន់មានផលិតផលណាមួយ។ សូមចូលមើលម្ដងទៀតនៅពេលក្រោយ។</p>
    </div>
    <?php else: ?>

    <div class="row">
        <?php foreach ($products as $p): ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <article class="card product-card h-100 border-0 shadow-sm">
                <?php if (!empty($p['main_image'])): ?>
                <a href="<?php echo base_url('other-products/' . $p['slug'] . '.html'); ?>">
                    <img src="<?php echo $p['main_image']; ?>"
                         class="card-img-top"
                         alt="<?php echo htmlspecialchars(html_entity_decode($p['name'], ENT_QUOTES, 'UTF-8')); ?>"
                         loading="lazy">
                </a>
                <?php else: ?>
                <a href="<?php echo base_url('other-products/' . $p['slug'] . '.html'); ?>">
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:220px;">
                        <i class="fas fa-image fa-3x text-muted" style="opacity:.3;"></i>
                    </div>
                </a>
                <?php endif; ?>

                <div class="card-body d-flex flex-column">
                    <h2 class="h6 font-weight-bold mb-2">
                        <a href="<?php echo base_url('other-products/' . $p['slug'] . '.html'); ?>"
                           class="text-dark text-decoration-none">
                            <?php echo htmlspecialchars(html_entity_decode($p['name'], ENT_QUOTES, 'UTF-8')); ?>
                        </a>
                    </h2>

                    <?php if ($p['price'] > 0): ?>
                    <p class="product-price mb-2">
                        <?php echo number_format((int)$p['price'], 0, ',', '.'); ?> đ
                    </p>
                    <?php endif; ?>

                    <?php if (!empty($p['meta_description'])): ?>
                    <p class="card-text text-muted small flex-grow-1">
                        <?php
                            $desc = html_entity_decode($p['meta_description'], ENT_QUOTES, 'UTF-8');
                            echo htmlspecialchars(mb_strlen($desc) > 120 ? mb_substr($desc, 0, 120) . '...' : $desc);
                        ?>
                    </p>
                    <?php endif; ?>

                    <div class="mt-3">
                        <a href="<?php echo base_url('other-products/' . $p['slug'] . '.html'); ?>"
                           class="btn btn-sm btn-outline-dark w-100">
                            មើលលម្អិត <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </article>
        </div>
        <?php endforeach; ?>
    </div>

    <?php endif; ?>
</div>
