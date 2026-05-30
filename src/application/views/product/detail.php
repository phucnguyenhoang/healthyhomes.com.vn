<style>
.product-detail-content { font-size: 1.05rem; line-height: 1.8; color: #333; }
.product-detail-content img { max-width: 100%; height: auto; border-radius: 4px; margin: 1rem 0; }
.product-detail-content h2, .product-detail-content h3 { margin-top: 2rem; }
.product-detail-content p { margin-bottom: 1.2rem; }
.product-price-lg { font-size: 1.6rem; font-weight: 700; color: #28a745; }
#productCarousel .carousel-item img {
    height: 420px;
    object-fit: cover;
    width: 100%;
    border-radius: 6px;
}
.carousel-thumb { cursor: pointer; opacity: .6; transition: opacity .15s; border: 2px solid transparent; border-radius: 4px; overflow: hidden; }
.carousel-thumb.active, .carousel-thumb:hover { opacity: 1; border-color: #343a40; }
.carousel-thumb img { width: 72px; height: 56px; object-fit: cover; display: block; }
</style>

<div class="pan-title p-pan-title">
    <div class="container">
        <h1 class="float-left">ផលិតផល</h1>
        <p class="float-right d-none d-md-block">
            <a href="/"><span>Rainbow® Cleaning System</span></a>
            <span>/</span>
            <a href="<?php echo base_url('other-products'); ?>">ផលិតផល</a>
            <span>/</span>
            <?php
                $bcName = html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8');
                if (mb_strlen($bcName) > 30) {
                    $bcName = mb_substr($bcName, 0, 30) . '...';
                }
            ?>
            <span><?php echo htmlspecialchars($bcName); ?></span>
        </p>
    </div>
</div>

<div class="container content-padding">
    <div class="row">

        <!-- Images column -->
        <div class="col-12 col-lg-6 mb-4">
            <?php $images = $product['images'] ?? []; ?>
            <?php if (!empty($images)): ?>

            <?php if (count($images) === 1): ?>
            <img src="<?php echo $images[0]['image_url']; ?>"
                 class="img-fluid rounded shadow-sm w-100"
                 style="max-height:420px; object-fit:cover;"
                 alt="<?php echo htmlspecialchars(html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8')); ?>">

            <?php else: ?>
            <div id="productCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <?php foreach ($images as $i => $img): ?>
                    <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                        <img src="<?php echo $img['image_url']; ?>"
                             alt="<?php echo htmlspecialchars(html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8')); ?> <?php echo $i + 1; ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">មុន</span>
                </a>
                <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">បន្ទាប់</span>
                </a>
            </div>

            <!-- Thumbnail strip -->
            <div class="d-flex flex-wrap mt-2" id="carouselThumbs">
                <?php foreach ($images as $i => $img): ?>
                <div class="carousel-thumb mr-1 mb-1 <?php echo $i === 0 ? 'active' : ''; ?>"
                     data-target="#productCarousel" data-slide-to="<?php echo $i; ?>">
                    <img src="<?php echo $img['image_url']; ?>"
                         alt="រូបភាព <?php echo $i + 1; ?>">
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php else: ?>
            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height:420px;">
                <i class="fas fa-image fa-4x text-muted" style="opacity:.3;"></i>
            </div>
            <?php endif; ?>
        </div>

        <!-- Info column -->
        <div class="col-12 col-lg-6 mb-4">
            <h1 class="font-weight-bold mb-3" style="font-size:1.8rem; line-height:1.35;">
                <?php echo htmlspecialchars(html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8')); ?>
            </h1>

            <?php if ($product['price'] > 0): ?>
            <p class="product-price-lg mb-3">
                <?php echo number_format((int)$product['price'], 0, ',', '.'); ?> đ
            </p>
            <?php endif; ?>

            <?php if (!empty($product['meta_description'])): ?>
            <p class="lead text-muted mb-4" style="font-size:1rem;">
                <?php echo htmlspecialchars(html_entity_decode($product['meta_description'], ENT_QUOTES, 'UTF-8')); ?>
            </p>
            <?php endif; ?>

            <a href="<?php echo base_url('support/contact-us'); ?>"
               class="btn btn-dark btn-lg mb-2 mr-2">
                <i class="fas fa-phone-alt mr-2"></i>ទំនាក់ទំនងដើម្បីទិញ
            </a>
            <a href="<?php echo base_url('request-demo'); ?>"
               class="btn btn-outline-dark btn-lg mb-2">
                <i class="fas fa-home mr-2"></i>សាកល្បងនៅផ្ទះ
            </a>
        </div>

    </div>

    <!-- Description -->
    <?php if (!empty($product['description'])): ?>
    <div class="row mt-2">
        <div class="col-12">
            <hr>
            <h2 class="h5 font-weight-bold mb-4">ការពិពណ៌នាផលិតផល</h2>
            <div class="product-detail-content mb-5">
                <?php echo $product['description']; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Back button -->
    <div class="text-center mt-3 mb-4">
        <a href="<?php echo base_url('other-products'); ?>" class="btn btn-outline-dark">
            <i class="fas fa-arrow-left mr-1"></i> មើលផលិតផលទាំងអស់
        </a>
    </div>
</div>

<?php if (count($images ?? []) > 1): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var $carousel = $('#productCarousel');
    var $thumbs   = $('#carouselThumbs .carousel-thumb');

    $carousel.on('slide.bs.carousel', function (e) {
        $thumbs.removeClass('active').eq(e.to).addClass('active');
    });

    $thumbs.on('click', function () {
        $carousel.carousel(parseInt($(this).data('slide-to'), 10));
    });
});
</script>
<?php endif; ?>
