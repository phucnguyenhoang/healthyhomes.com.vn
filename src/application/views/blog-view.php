<div class="pan-title p-pan-title">
	<div class="container">
		<h1 class="float-left">Blogs</h1>
		<p class="float-right d-none d-md-block">
			<a href="/">
				<span>Rainbow® Cleaning System</span>
			</a>
			<span>/</span>
			<span>Blogs</span>
		</p>
	</div>
</div>
<br>
<div class="container">
	<div class="card">
		<div class="card-body pan-blog-view">
			<div class="page-header">
				<h3><?php echo ($title); ?></h3>
			</div>
			<p><em><?php echo ($description); ?></em></p>
			<div>
				<?php echo htmlspecialchars_decode($content); ?>
			</div>

			<hr>
			<div class="pull-right">
				<a href="<?php echo base_url('blogs'); ?>" class="btn btn-sm btn-outline-secondary" role="button">
					&larr; Bài viết khác
				</a>
			</div>
		</div>
	</div>
</div>
<br>