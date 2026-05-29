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

				<p class="pan-intro">Từ năm 1936, Rexair đã phát minh Rainbow® - Hệ Thống Làm Sạch Tổng Hợp, được thiết kế để cải thiện môi trường sống xung quanh chúng ta, với hàng triệu người dùng hài lòng trên toàn thế giới.</p>
			</div>
			<div class="col-md-3">
				<div class="pan-nav">
					<h3>Khám Phá</h3>
					<ul>
						<li><a href="<?php prUrl('san-pham') ?>">Hệ thống làm sạch tổng hợp Rainbow</a></li>
						<li><a href="<?php prUrl('san-pham/cach-thuc-mua-hang') ?>">Cách thức mua hàng</a></li>
						<li><a href="<?php prUrl('san-pham/dung-cu') ?>">Dụng cụ Rainbow</a></li>
						<li><a href="<?php prUrl('gioi-thieu/gioi-thieu-ve-chung-toi') ?>">Công ty chúng tôi</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="pan-nav">
					<h3>Thông Tin</h3>
					<ul>
						<li><a href="https://rainbowsystem.com/support/find-a-distributor" target="_blank">Tìm nhà phân phối</a></li>
						<li><a href="<?php prUrl('ho-tro/huong-dan-su-dung') ?>">Hướng dẫn sử dụng sản phẩm</a></li>
						<li><a href="<?php prUrl('yeu-cau-dung-thu-tai-nha') ?>">Yêu cầu dùng thử tại nhà</a></li>
						<li><a href="<?php prUrl('ho-tro/dat-mua-phu-kien') ?>">Mua linh kiện & phụ kiện</a></li>
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