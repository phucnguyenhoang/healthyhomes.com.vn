<div class="pan-title p-pan-title">
  <div class="container">
    <h1 class="float-left">Hoạt động</h1>
    <p class="float-right d-none d-md-block">
      <a href="/">
        <span>Rainbow® Cleaning System</span>
      </a>
      <span>/</span>
      <span>Hoạt động</span>
    </p>
  </div>
</div>
<br>
<div class="container">
  <div class="card">
    <div class="card-body pan-blog-view">
      <div class="page-header">
        <h3><?php echo ($article['title']); ?></h3>
      </div>
      <p><em><?php echo ($article['description']); ?></em></p>
      <div>
        <?php echo htmlspecialchars_decode($article['content']); ?>
      </div>

      <hr>
      <div class="pull-right">
        <a href="<?php echo base_url('hoat-dong'); ?>" class="btn btn-sm btn-outline-secondary" role="button">
          &larr; Hoạt động khác
        </a>
      </div>
    </div>
  </div>
</div>
<br>