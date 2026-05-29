<div class="pan-title p-pan-title">
	<div class="container">
		<h1 class="float-left">Yêu cầu dùng thử tại nhà</h1>
		<p class="float-right d-none d-md-block">
			<a href="/">
				<span>Rainbow® Cleaning System</span>
			</a>
			<span>/</span>
			<span>Yêu cầu dùng thử tại nhà</span>
		</p>
	</div>
</div>

<div class="container content-padding">
	<div class="row">
		<div class="col-md-6">
			<h2 style="text-transform: capitalize; margin-bottom: 36px">Yêu cầu dùng thử tại nhà</h2>
			<p style="line-height: 1.8">Để xem cách thức Rainbow có thể đáp ứng nhu cầu làm sạch cụ thể của bạn như thế nào, chúng tôi mời bạn xem nó trong nhà của bạn. Chỉ cần điền vào biểu mẫu bên dưới và chúng tôi sẽ gửi thông tin đến Nhà phân phối Rainbow được ủy quyền độc lập trong khu vực của bạn, họ sẽ liên hệ với bạn để lên lịch giới thiệu sản phẩm vào thời điểm thuận tiện cho bạn.</p>

			<form id="frmRequestDemo" method="POST" action="<?= base_url('submit-request-demo') ?>" class="form" style="margin-bottom: 36px;">
				<div class="form-group">
			    <label for="txtName">Họ và tên <span style="color: red">*</span></label>
			    <input type="text" class="form-control" id="txtName" name="txtName" required placeholder="Họ & tên">
			  </div>

			  <div class="form-group">
			    <label for="txtAddress">Địa chỉ đầy đủ <span style="color: red">*</span></label>
			    <input type="text" class="form-control" id="txtAddress" name="txtAddress" aria-describedby="addressHelp" required>
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
			  
			  <div class="g-recaptcha" data-sitekey="<?php echo CAPTCHA_SITE_KEY; ?>"></div>

			  <button type="submit" class="btn btn-primary mt-4"><span class="fas fa-paper-plane"></span> Xác Nhận</button>
			  <small class="form-text text-muted">
			  	Các mục được đánh dấu * là bắt buộc. Để được hỗ trợ ngay lập tức, vui lòng liên hệ với nhà phân phối Rainbow ủy quyền tại địa phương.
			  </small>	  
			</form>
		</div>
		<div class="col-md-6">
			<img src="<?php prImg('rainbow-demo.jpg') ?>" class="d-block w-100">	
			<p style="margin-top: 36px;">Trong buổi thuyết trình, một đại diện được đào tạo sẽ giải thích các tính năng độc đáo của Rainbow, và cách so sánh với các phương pháp làm sạch truyền thống. Bạn không bắt buộc phải mua hàng nếu chưa hài lòng.</p>

			<div class="rd-pan-carousel">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				  <ol class="carousel-indicators">
				    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				  </ol>
				  <div class="carousel-inner">
				    <div class="carousel-item active">
				      <p>Đây là chiếc máy Rainbow thứ hai mà tôi mua cho gia đình và tôi sẽ không phải mua thêm loại nào nữa. Tôi mua chiếc máy đầu tiên từ năm 2016 và cho tới tận bây giờ đã là 2020, nó vẫn hoạt động ngoài mong đợi của tôi, thậm chí có thể nói là trên cả tuyệt vời ấy chứ.</p>
				      <p style="padding-bottom: 26px;"><strong><em>Chị Nguyễn Hằng – Q.7</em></strong></p>
				    </div>
				    <div class="carousel-item">
				      <p>Tôi viết ở đây là vì muốn gửi lời cảm ơn đến Rista Phạm – người đã cho tôi nhận ra rằng, tôi sở hữu Rainbow vì lợi ích sức khỏe của tôi và gia đình chứ không phải chỉ đơn thuần là việc mua – bán một  chiếc máy. Cô bé Rista Phạm đã đến tận nhà tôi dù phải đi rất xa, tư vấn cho đến khi chúng tôi không còn nghi ngờ gì về khả năng của nó nữa. Rainbow thật sự tuyệt vời và Rista Phạm cũng vậy.</p>
				      <p style="padding-bottom: 26px;"><strong><em>Chị Phạm Thùy Giang – Bình Dương</em></strong></p>
				    </div>
				    <div class="carousel-item">
				      <p>Khi tôi cần hỗ trợ, chỉ với một cuộc gọi, nhân viên Healthy Homes Viet Nam  có mặt rất nhanh để giải quyết vấn đề cho tôi và hơn nữa họ rất nhiệt tình và lịch sự. Tôi yêu quý chiếc máy Rainbow của mình, yêu quý cả công ty Healthy Homes Viet Nam nữa. Tôi hoàn toàn hài lòng với các dịch vụ chăm sóc khách hàng ở đây. Đây là công ty tốt nhất mà tôi từng mua hàng.</p>
				      <p style="padding-bottom: 26px;"><strong><em>Chị Mỹ Phương – Q.10</em></strong></p>
				    </div>
				  </div>
				</div>
			</div>

			<div class="row">
				<div class="col-3">
					<img src="<?php prImg('DSAmemberlogo-269x300.jpg') ?>" class="d-block w-100">
				</div>
				<div class="col-9">
					<p>Rexair là một thành viên đáng tự hào của Hiệp hội bán hàng trực tiếp và tuân thủ Quy tắc đạo đức nghề nghiệp DSA.</p>
				</div>
			</div>
		</div>
	</div>
</div>