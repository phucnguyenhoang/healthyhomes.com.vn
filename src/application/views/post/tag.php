<style>
.post-card { transition: transform .18s, box-shadow .18s; }
.post-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,.12) !important; }
.post-card .card-img-top { height: 200px; object-fit: cover; }
.post-tag { text-decoration: none; }
.post-tag:hover { text-decoration: underline; }
</style>

<div class="pan-title p-pan-title">
    <div class="container">
        <h1 class="float-left">ប្រធានបទ: <?php echo htmlspecialchars($tag); ?></h1>
        <p class="float-right d-none d-md-block">
            <a href="/"><span>Rainbow® Cleaning System</span></a>
            <span>/</span>
            <a href="<?php echo base_url('blog'); ?>">អត្ថបទ</a>
            <span>/</span>
            <span><?php echo htmlspecialchars($tag); ?></span>
        </p>
    </div>
</div>

<div class="container content-padding">

    <?php if (empty($posts)): ?>
    <div class="text-center py-5 text-muted">
        <i class="fas fa-search fa-3x mb-3" style="opacity:.3;"></i>
        <p>មិនរករឃើញអត្ថបទណាមួយសម្រាប់ប្រធានបទ <strong>"<?php echo htmlspecialchars($tag); ?>"</strong>។</p>
        <a href="<?php echo base_url('blog'); ?>" class="btn btn-dark btn-sm">មើលអត្ថបទទាំងអស់</a>
    </div>
    <?php else: ?>

    <div class="row">
        <?php foreach ($posts as $p): ?>
        <?php $ptags = !empty($p['tags']) ? array_filter(array_map('trim', explode(',', $p['tags']))) : []; ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <article class="card post-card h-100 border-0 shadow-sm">
                <?php if (!empty($p['thumbnail'])): ?>
                <a href="<?php echo base_url('blog/' . $p['slug'] . '.html'); ?>">
                    <img src="<?php echo $p['thumbnail']; ?>"
                         class="card-img-top" alt="<?php echo htmlspecialchars(html_entity_decode($p['title'], ENT_QUOTES, 'UTF-8')); ?>"
                         loading="lazy">
                </a>
                <?php endif; ?>
                <div class="card-body d-flex flex-column">
                    <?php if ($ptags): ?>
                    <div class="mb-2">
                        <?php foreach ($ptags as $t): ?>
                        <a href="<?php echo base_url('blog/' . urlencode($t)); ?>"
                           class="badge badge-<?php echo $t === $tag ? 'dark' : 'light text-dark border'; ?> post-tag">
                            <i class="fas fa-tag fa-xs"></i> <?php echo htmlspecialchars($t); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <h2 class="h6 font-weight-bold mb-2">
                        <a href="<?php echo base_url('blog/' . $p['slug'] . '.html'); ?>"
                           class="text-dark text-decoration-none">
                            <?php echo htmlspecialchars(html_entity_decode($p['title'], ENT_QUOTES, 'UTF-8')); ?>
                        </a>
                    </h2>

                    <?php if (!empty($p['description'])): ?>
                    <p class="card-text text-muted small flex-grow-1">
                        <?php
                            $desc = strip_tags(html_entity_decode($p['description'], ENT_QUOTES, 'UTF-8'));
                            echo htmlspecialchars(mb_strlen($desc) > 120 ? mb_substr($desc, 0, 120) . '...' : $desc);
                        ?>
                    </p>
                    <?php endif; ?>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            <?php echo date('d/m/Y', strtotime($p['created_at'])); ?>
                        </small>
                        <a href="<?php echo base_url('blog/' . $p['slug'] . '.html'); ?>"
                           class="btn btn-sm btn-outline-dark">
                            មើលបន្ថែម <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </article>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Phân trang -->
    <?php if (!empty($pagination) && $pagination['total'] > 1): ?>
    <nav aria-label="ទំព័រ" class="mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php echo $pagination['current'] <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $pagination['current'] - 1; ?>" aria-label="ទំព័រមុន">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
            <?php for ($i = 1; $i <= $pagination['total']; $i++): ?>
            <li class="page-item <?php echo $i == $pagination['current'] ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item <?php echo $pagination['current'] >= $pagination['total'] ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $pagination['current'] + 1; ?>" aria-label="ទំព័របន្ទាប់">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>

    <?php endif; ?>
</div>
