<div class="pan-title p-pan-title">
	<div class="container">
		<h1 class="float-left">ផលិតផលផ្សេងទៀត</h1>
		<p class="float-right d-none d-lg-block">
			<a href="/"><span>Rainbow® Cleaning System</span></a>
			<span>/</span>
			<span>ផលិតផលផ្សេងទៀត</span>
		</p>
	</div>
</div>
<div class="container pan-cooking">
	<?php if (empty($gifts)) : ?>
		<div class="alert alert-success" role="alert">No products available!</div>
	<?php else : ?>
		<div class="row">
			<?php foreach ($gifts as $gift) : ?>
				<?php if (!empty($gift["active"])) : ?>
					<div class="col-lg-4 col-md-6" style="padding-bottom: 1rem;">
						<div class="panel panel-default" style="border: 1px solid #ccc; border-radius: 5px; padding: .8rem;">
							<div class="panel-body">
								<img src="<?= $gift['thumbnail'] ?>" class="d-block w-100" style="height: 260px; object-fit: scale-down;">
								<h5><?= $gift['name'] ?></h5>
								<div style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
									<h5>តម្លៃ:</h5>
									<h5><strong><?= number_format($gift['price']) ?> vnđ</strong></h5>
								</div>
								<p style="max-height: 120px; overflow-y: auto; text-align: justify;"><?= nl2br(convertLinksToAnchors($gift['description'])) ?></p>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>
