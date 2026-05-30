<?php $version = ENVIRONMENT == 'development' ? '?v=' . rand(1, 1000) . time() : APP_VERSION; ?>

<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<table>
					<tr>
						<td>
							<p>
								<img class="img-logo" src="<?php prImg('main-logo.png') ?>">
							</p>
						</td>
						<td>
							<p>
								<strong>
									<h9 style="font-size: 15px!important;">CÔNG TY TNHH HEALTHY HOMES VIET NAM</h9>
								</strong><br>
								<strong>MST:</strong> 0315719824<br>
								263/2A1 Nguyễn Văn Đậu, Phường Bình Lợi Trung, TP. Hồ Chí Minh, Việt Nam.
							</p>
						</td>
					</tr>
				</table>

				<p class="pan-intro">ចាប់តាំងពីឆ្នាំ ១៩៣៦ Rexair បានបង្កើត Rainbow® - ប្រព័ន្ធសម្អាតទូទៅ ដែលត្រូវបានរចនាឡើងដើម្បីកែលម្អបរិស្ថានរស់នៅរបស់យើង ជាមួយអ្នកប្រើប្រាស់ពេញចិត្តរាប់លាននាក់ទូទាំងពិភពលោក។</p>
			</div>
			<div class="col-md-3">
				<div class="pan-nav">
					<h3>ស្វែងយល់</h3>
					<ul>
						<li><a href="<?php prUrl('products') ?>">ប្រព័ន្ធសម្អាតទូទៅ Rainbow</a></li>
						<li><a href="<?php prUrl('products/how-to-buy') ?>">របៀបទិញ</a></li>
						<li><a href="<?php prUrl('products/tools') ?>">ឧបករណ៍ Rainbow</a></li>
						<li><a href="<?php prUrl('about/about-us') ?>">ក្រុមហ៊ុនរបស់យើង</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="pan-nav">
					<h3>ព័ត៌មាន</h3>
					<ul>
						<li><a href="https://rainbowsystem.com/support/find-a-distributor" target="_blank">ស្វែងរកអ្នកចែកចាយ</a></li>
						<li><a href="<?php prUrl('support/user-manual') ?>">មគ្គុទ្ទេសក៍ប្រើប្រាស់ផលិតផល</a></li>
						<li><a href="<?php prUrl('request-demo') ?>">ស្នើសុំការបង្ហាញនៅផ្ទះ</a></li>
						<li><a href="<?php prUrl('support/supplies') ?>">ទិញគ្រឿងបន្ថែម</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="hidBaseUrl" value="<?php echo (base_url()); ?>">

<script type="text/javascript" src="/resources/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="/resources/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/resources/js/main.js?v=<?= $version ?>"></script>
</body>

</html>
