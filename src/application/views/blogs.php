<div class="pan-title p-pan-title">
	<div class="container">
		<h1 class="float-left">អត្ថបទ</h1>
		<p class="float-right d-none d-md-block">
			<a href="/"><span>Rainbow® Cleaning System</span></a>
			<span>/</span>
			<span>អត្ថបទ</span>
		</p>
	</div>
</div>
<br>
<div class="container">
	<div class="card">
		<div class="card-body">
			<?php if (empty($blogs)) : ?>
				<div class="alert alert-warning" role="alert">មិនទាន់មានអត្ថបទ!</div>
			<?php else : ?>
				<?php $i = 0; ?>
				<?php foreach ($blogs as $blog) : ?>
					<?php $i = $i+1; ?>
					<div class="row">
						<div class="col-sm-2">
							<a href="<?php prUrl('/blog/'.$blog['alias'].'-'.$blog['id'].'.html'); ?>" class="thumbnail">
								<img src="<?php if (!empty($blog['thumbnail'])) echo $blog['thumbnail']; else echo ('/resources/imgs/imgthumb.jpg'); ?>" width="100%" alt="<?php echo $blog['title']; ?>">
							</a>
						</div>
						<div class="col-sm-10">
							<a href="<?php prUrl('/blog/'.$blog['alias'].'-'.$blog['id'].'.html'); ?>"><strong><?php echo $blog['title']; ?></strong></a><br>
							<em><?php echo $blog['description']; ?></em>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<?php if (!empty($pagination)) : ?>
			<?php
				$currPage = $pagination['currPage'];
				$numPage = $pagination['numPage'];
			?>
			<div class="panel-footer text-center">
				<nav aria-label="Page navigation">
				  	<ul class="pagination">
					    <li <?php echo ($currPage == 1 ? 'class="disabled"' : ''); ?>>
					      	<a href="<?php echo ($currPage == 1 ? '#' : base_url('/blog?page='.($currPage-1))); ?>" aria-label="Previous">
					        	<span aria-hidden="true">&laquo;</span>
					      	</a>
					    </li>
					    <?php if ($numPage <= 5) : ?>
						    <?php for ($i = 1; $i <= $numPage; $i++) : ?>
						    	<?php
						    		if ($i == $currPage) { $active = 'class="active"'; $link = '#'; }
						    		else { $active = ''; $link = base_url('/blog?page='.$i); }
						    	?>
						    	<li <?php echo $active; ?>><a href="<?php echo $link; ?>"><?php echo $i; ?></a></li>
							<?php endfor; ?>
						<?php else : ?>
							<?php if ($currPage >= 4) : ?>
								<li class="disabled hidden-xs"><a href="#">...</a></li>
							<?php endif; ?>
							<?php for ($i = $currPage-2; $i <= $currPage+2; $i++) : ?>
						    	<?php
						    		if ($i < 1 || $i > $numPage) continue;
						    		if ($i == $currPage) { $active = 'class="active"'; $link = '#'; }
						    		else { $active = ''; $link = base_url('/blog?page='.$i); }
						    	?>
						    	<li <?php echo $active; ?>><a href="<?php echo $link; ?>"><?php echo $i; ?></a></li>
							<?php endfor; ?>
							<?php if ($currPage <= $numPage - 3) : ?>
								<li class="disabled hidden-xs"><a href="#">...</a></li>
							<?php endif; ?>
						<?php endif; ?>
					    <li <?php echo ($currPage == $numPage ? 'class="disabled"' : ''); ?>>
					      	<a href="<?php echo ($currPage == $numPage ? '#' : base_url('/blog?page='.($currPage+1))); ?>" aria-label="Next">
					        	<span aria-hidden="true">&raquo;</span>
					      	</a>
					    </li>
				  	</ul>
				</nav>
			</div>
		<?php endif; ?>
	</div>
</div>
<br>
