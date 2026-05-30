<div class="pan-title p-pan-title">
	<div class="container">
		<h1 class="float-left">ទំនាក់ទំនងយើង</h1>
		<p class="float-right d-none d-md-block">
			<a href="/">
				<span>Rainbow® Cleaning System</span>
			</a>
			<span>/</span>
			<a href="<?php prUrl('support') ?>">ការគាំទ្រ</a>
			<span>/</span>
			<span>ទំនាក់ទំនងយើង</span>
		</p>
	</div>
</div>

<div class="container content-padding">
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<p><strong>Healthy Homes Viet Nam – សេវាអតិថិជន</strong></p>
					<p>
						<strong>ទូរស័ព្ទ:</strong> +84 795 345 799<br>
						<strong>អាសយដ្ឋាន:</strong> Toà nhà Healthy Homes, 263/2A1 Nguyễn Văn Đậu, Phường Bình Lợi Trung, TP. Hồ Chí Minh, Việt Nam.
					</p>
				</div>
				<div class="col-md-6">
					<p><strong>ការគាំទ្រតាមអ៊ីនធឺណិត</strong></p>
					<p>
						<a href="<?php prUrl('support/faq') ?>">សំណួរញឹកញាប់</a>
						<br>
						<a href="<?php prUrl('support/user-manual') ?>">ទាញយកមគ្គុទ្ទេសក៍ប្រើប្រាស់</a>
						<br>
						<a href="<?php prUrl('support/videos') ?>">Videos Rainbow</a>
						<br>
						<a href="<?php prUrl('support/cleaning-tips') ?>">គន្លឹះសម្អាត</a>
						<br>
						<a href="<?php prUrl('support/datasheet') ?>">ឯកសារយោង</a>
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
			<p>ប្រសិនបើអ្នកមានសំណួរអំពីផលិតផល Rainbow ណាមួយ រួមមានសំណួរទាក់ទងនឹងការជួសជុល និងការថែទាំដែលទទួលស្គាល់ សូមទំនាក់ទំនងផ្នែកសេវាអតិថិជន Healthy Homes Viet Nam។ ពួកគេនឹងពិគ្រោះជាមួយអ្នក ហើយផ្ដល់ចម្លើយដែលអ្នករកឃើញ ឬណែនាំអ្នកទៅអ្នកចែកចាយ Rainbow ដែលទទួលស្គាល់ (បើមាន) ដែលអាចជួយអ្នកទទួលបានព័ត៌មានដែលត្រូវការ។</p>

			<form id="frmContactUs" method="POST" action="<?= base_url('submit-contact-us') ?>" class="form">
				<div class="form-group">
					<label for="txtName">ឈ្មោះ <span style="color: red">*</span></label>
					<input type="text" class="form-control" id="txtName" name="txtName" required placeholder="ឈ្មោះ">
				</div>

				<div class="form-group">
					<label for="txtAddress">អាសយដ្ឋានពេញ</label>
					<input type="text" class="form-control" id="txtAddress" name="txtAddress" aria-describedby="addressHelp">
					<small id="addressHelp" class="form-text text-muted">ឧទាហរណ៍: 36/7 Đường Bùi Tư Toàn, P. An Lạc, Q. Bình Tân, Tp. HCM</small>
				</div>

				<div class="form-group">
					<label for="txtEmail">អ៊ីមែល <span style="color: red">*</span></label>
					<input type="email" class="form-control" name="txtEmail" id="txtEmail" placeholder="អ៊ីមែល" required>
				</div>

				<div class="form-group">
					<label for="txtPhone">លេខទូរស័ព្ទ <span style="color: red">*</span></label>
					<input type="text" class="form-control" name="txtPhone" id="txtPhone" placeholder="លេខទូរស័ព្ទ" required>
				</div>

				<div class="form-group">
					<label><strong>អ្នកចាប់អារម្មណ៍ចំពោះ</strong></label>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="1" id="chkSupplies" name="userFocus[]">
						<label class="form-check-label" for="chkSupplies">
							សេវា/គ្រឿងផ្លាស់ប្ដូរ
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="2" id="chkWarranty" name="userFocus[]">
						<label class="form-check-label" for="chkWarranty">
							ការធានា
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="3" id="chkDistribution" name="userFocus[]">
						<label class="form-check-label" for="chkDistribution">
							អ្នកចែកចាយ Rainbow
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="4" id="chkProductInfo" name="userFocus[]">
						<label class="form-check-label" for="chkProductInfo">
							ព័ត៌មានផលិតផល
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="5" id="chkTryAtHome" name="userFocus[]">
						<label class="form-check-label" for="chkTryAtHome">
							បង្ហាញនៅផ្ទះ
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="6" id="chkUserManual" name="userFocus[]">
						<label class="form-check-label" for="chkUserManual">
							មគ្គុទ្ទេសក៍ប្រើប្រាស់
						</label>
					</div>
				</div>

				<div class="form-group">
					<label for="txtMessage">សារ</label>
					<textarea class="form-control" name="txtMessage" id="txtMessage" placeholder="សារ" rows="5"></textarea>
				</div>

				<div class="g-recaptcha" data-sitekey="<?php echo CAPTCHA_SITE_KEY; ?>"></div>

				<button type="submit" class="btn btn-primary mt-4"><span class="fas fa-paper-plane"></span> ផ្ញើ</button>
			</form>
		</div>
	</div>
</div>
