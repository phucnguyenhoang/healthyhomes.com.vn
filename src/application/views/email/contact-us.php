<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Contact Us Email</title>
</head>

<body>
	<h2>New Contact Us Request from Healthy Homes Viet Nam</h2>
	<p>You have received a new contact us request from the Healthy Homes Viet Nam website.</p>
	<p><strong>Details:</strong></p>
	<div style="border: 1px solid #ccc; padding: 20px; margin: 10px 0; max-width: 600px;">

		<p><strong>Name:</strong> <?php pr($name) ?></p>
		<p><strong>Address:</strong> <?php pr($address ?? '') ?></p>
		<p><strong>Email:</strong> <?php pr($email) ?></p>
		<p><strong>Phone:</strong> <?php pr($phone) ?></p>
		
		<?php if (!empty($userFocus)) : ?>
			<p><strong>User Focus:</strong></p>
			<ul>
				<?php foreach ($userFocus as $focus) : ?>
					<li><?php pr($focus) ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if (!empty($message)) : ?>
			<p><strong>Message:</strong></p>
			<p style="font-style: italic;"><?= nl2br(htmlspecialchars($message)) ?></p>
		<?php endif; ?>
	</div>
	<p>Thank you for your attention.</p>
	<p>Best regards,</p>
	<p>Healthy Homes Viet Nam Team</p>
</body>

</html>