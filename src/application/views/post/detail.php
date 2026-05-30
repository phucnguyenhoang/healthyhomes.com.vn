<style>
.post-detail-content { font-size: 1.05rem; line-height: 1.8; color: #333; }
.post-detail-content img { max-width: 100%; height: auto; border-radius: 4px; margin: 1rem 0; }
.post-detail-content h2, .post-detail-content h3 { margin-top: 2rem; }
.post-detail-content p { margin-bottom: 1.2rem; }
.tag-pill { font-size: .82rem; text-decoration: none; }
.tag-pill:hover { text-decoration: none; opacity: .8; }
.post-meta { font-size: .9rem; }
</style>

<div class="pan-title p-pan-title">
    <div class="container">
        <h1 class="float-left">អត្ថបទ</h1>
        <p class="float-right d-none d-md-block">
            <a href="/"><span>Rainbow® Cleaning System</span></a>
            <span>/</span>
            <a href="<?php echo base_url('blog'); ?>">អត្ថបទ</a>
            <span>/</span>
            <?php
                $bcTitle = html_entity_decode($post['title'], ENT_QUOTES, 'UTF-8');
                if (mb_strlen($bcTitle) > 30) {
                    $bcTitle = mb_substr($bcTitle, 0, 30) . '...';
                }
            ?>
            <span><?php echo htmlspecialchars($bcTitle); ?></span>
        </p>
    </div>
</div>

<div class="container content-padding">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-8">

            <!-- Tiêu đề bài viết -->
            <h1 class="font-weight-bold mb-3" style="font-size:2rem; line-height:1.35;">
                <?php echo htmlspecialchars(html_entity_decode($post['title'], ENT_QUOTES, 'UTF-8')); ?>
            </h1>

            <!-- Thông tin bài viết -->
            <div class="post-meta text-muted d-flex flex-wrap align-items-center border-bottom pb-3 mb-4">
                <?php if (!empty($tags)): ?>
                <div class="mr-3">
                    <?php foreach ($tags as $tag): ?>
                    <a href="<?php echo base_url('blog/' . urlencode($tag)); ?>"
                       class="badge badge-dark tag-pill mr-1 px-2 py-1">
                        <i class="fas fa-tag fa-xs mr-1"></i><?php echo htmlspecialchars($tag); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <span class="mr-3">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    <time datetime="<?php echo date('c', strtotime($post['created_at'])); ?>">
                        <?php echo date('d/m/Y', strtotime($post['created_at'])); ?>
                    </time>
                </span>
                <?php if (!empty($post['updated_at']) && $post['updated_at'] !== $post['created_at']): ?>
                <span>
                    <i class="fas fa-sync-alt mr-1"></i>
                    ធ្វើបច្ចុប្បន្នភាព: <?php echo date('d/m/Y', strtotime($post['updated_at'])); ?>
                </span>
                <?php endif; ?>
            </div>

            <!-- Mô tả ngắn -->
            <?php if (!empty($post['description'])): ?>
            <p class="lead text-muted mb-4">
                <?php echo htmlspecialchars(html_entity_decode($post['description'], ENT_QUOTES, 'UTF-8')); ?>
            </p>
            <?php endif; ?>

            <!-- Ảnh đại diện -->
            <?php if (!empty($post['thumbnail'])): ?>
            <figure class="mb-4">
                <img src="<?php echo $post['thumbnail']; ?>"
                     class="img-fluid rounded shadow-sm w-100"
                     alt="<?php echo htmlspecialchars(html_entity_decode($post['title'], ENT_QUOTES, 'UTF-8')); ?>"
                     style="max-height:480px; object-fit:cover;">
            </figure>
            <?php endif; ?>

            <!-- Nội dung bài viết -->
            <div class="post-detail-content mb-5">
                <?php echo $post['content']; ?>
            </div>

            <!-- Danh sách tag cuối bài -->
            <?php if (!empty($tags)): ?>
            <div class="border-top pt-4 pb-2">
                <strong class="text-muted small text-uppercase">
                    <i class="fas fa-tags mr-1"></i> ប្រធានបទ
                </strong>
                <div class="mt-2">
                    <?php foreach ($tags as $tag): ?>
                    <a href="<?php echo base_url('blog/' . urlencode($tag)); ?>"
                       class="btn btn-sm btn-outline-secondary mr-1 mb-1 tag-pill">
                        #<?php echo htmlspecialchars($tag); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Nút quay lại -->
            <div class="text-center mt-5">
                <a href="<?php echo base_url('blog'); ?>" class="btn btn-dark">
                    <i class="fas fa-th-large mr-1"></i> មើលអត្ថបទទាំងអស់
                </a>
            </div>

        </div>
    </div>
</div>
