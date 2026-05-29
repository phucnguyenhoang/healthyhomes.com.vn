<div class="pan-title p-pan-title">
	<div class="container">
		<h1 class="float-left">Liên hệ chúng tôi</h1>
		<p class="float-right d-none d-md-block">
			<a href="/">
				<span>Rainbow® Cleaning System</span>
			</a>
			<span>/</span>
			<a href="<?php prUrl('ho-tro') ?>">Hỗ trợ</a>
			<span>/</span>
			<span>Liên hệ chúng tôi</span>
		</p>
	</div>
</div>

<div class="container content-padding">
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<p><strong>Healthy Homes Viet Nam – Dịch Vụ Khách Hàng</strong></p>
					<p>
						<strong>Điện thoại:</strong> +84 795 345 799<br>
						<strong>Địa chỉ:</strong> Toà nhà Healthy Homes, 263/2A1 Nguyễn Văn Đậu, Phường Bình Lợi Trung, TP. Hồ Chí Minh, Việt Nam.
					</p>
				</div>
				<div class="col-md-6">
					<p><strong>Hỗ trợ trực tuyến</strong></p>
					<p>
						<a href="<?php prUrl('ho-tro/nhung-cau-hoi-thuong-gap') ?>">Những câu hỏi thường gặp</a>
						<br>
						<a href="<?php prUrl('ho-tro/huong-dan-su-dung') ?>">Tải về hướng dẫn sử dụng</a>
						<br>
						<a href="<?php prUrl('ho-tro/videos') ?>">Những videos về Rainbow</a>
						<br>
						<a href="<?php prUrl('ho-tro/nhung-meo-lam-sach') ?>">Những mẹo làm sạch</a>
						<br>
						<a href="<?php prUrl('ho-tro/du-lieu-tham-khao') ?>">Dữ liệu tham khảo</a>
					</p>
				</div>
			</div>

			<img src="<?php prImg('Rexair-Headquarters.jpg') ?>" class="d-block w-100">
			<p>Rexair World Headquarters <br>
				50 West Big Beaver, Suite 350<br>
				Troy, MI 48084 <br>
				USA</p>

			<img src="<?php prImg('rexair-logo-450x98.jpg') ?>" class="d-block w-100">
		</div>
		<div class="col-md-6">
			<p>Nếu bạn có thắc mắc về bất kỳ sản phẩm Rainbow nào, bao gồm mọi câu hỏi về dịch vụ sửa chữa và bảo trì được ủy quyền, vui lòng liên hệ với Bộ phận dịch vụ khách hàng của Healthy Homes Viet Nam. Họ sẽ tham khảo ý kiến ​​của bạn và cung cấp cho bạn câu trả lời bạn tìm kiếm hoặc sẽ hướng dẫn bạn đến Nhà phân phối Rainbow ủy quyền tại khu vực (nếu có), người có thể giúp bạn có được thông tin bạn cần.</p>

			<form id="frmContactUs" method="POST" action="<?= base_url('submit-contact-us') ?>" class="form">
				<div class="form-group">
					<label for="txtName">Họ và tên <span style="color: red">*</span></label>
					<input type="text" class="form-control" id="txtName" name="txtName" required placeholder="Họ & tên">
				</div>

				<div class="form-group">
					<label for="txtAddress">Địa chỉ đầy đủ</label>
					<input type="text" class="form-control" id="txtAddress" name="txtAddress" aria-describedby="addressHelp">
					<small id="addressHelp" class="form-text text-muted">Ví dụ: 36/7 Đường Bùi Tư Toàn, P. An Lạc, Q. Bình Tân, Tp. HCM</small>
				</div>

				<div class="form-group">
					<label for="txtEmail">Địa chỉ Email <span style="color: red">*</span></label>
					<input type="email" class="form-control" name="txtEmail" id="txtEmail" placeholder="Địa chỉ Email" required>
				</div>

				<div class="form-group">
					<label for="txtPhone">Số điện thoại liên hệ <span style="color: red">*</span></label>
					<input type="text" class="form-control" name="txtPhone" id="txtPhone" placeholder="Số điện thoại liên hệ" required>
				</div>

				<div class="form-group">
					<label><strong>Bạn đang quan tâm về</strong></label>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="1" id="chkSupplies" name="userFocus[]">
						<label class="form-check-label" for="chkSupplies">
							Dịch vụ/Linh kiện
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="2" id="chkWarranty" name="userFocus[]">
						<label class="form-check-label" for="chkWarranty">
							Bảo hành
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="3" id="chkDistribution" name="userFocus[]">
						<label class="form-check-label" for="chkDistribution">
							Nhà phân phối Rainbow
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="4" id="chkProductInfo" name="userFocus[]">
						<label class="form-check-label" for="chkProductInfo">
							Thông tin sản phẩm
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="5" id="chkTryAtHome" name="userFocus[]">
						<label class="form-check-label" for="chkTryAtHome">
							Dùng thử tại nhà
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="6" id="chkUserManual" name="userFocus[]">
						<label class="form-check-label" for="chkUserManual">
							Hướng dẫn sử dụng
						</label>
					</div>
				</div>

				<div class="form-group">
					<label for="txtMessage">Lời nhắn gửi</label>
					<textarea class="form-control" name="txtMessage" id="txtMessage" placeholder="Lời nhắn gửi" rows="5"></textarea>
				</div>
				
				<div class="g-recaptcha" data-sitekey="<?php echo CAPTCHA_SITE_KEY; ?>"></div>

				<button type="submit" class="btn btn-primary mt-4"><span class="fas fa-paper-plane"></span> Gửi</button>
			</form>
		</div>
	</div>
</div>