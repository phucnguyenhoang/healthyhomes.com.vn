<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Demo Request Email</title>
</head>

<body>
	<h2>New Demo Request from Healthy Homes Viet Nam</h2>
	<p>You have received a new demo request from the Healthy Homes Viet Nam website.</p>
	<p><strong>Details:</strong></p>
	<div style="border: 1px solid #ccc; padding: 20px; margin: 10px 0; max-width: 600px;">

		<p><strong>Name:</strong> <?php pr($name) ?></p>
		<p><strong>Address:</strong> <?php pr($address) ?></p>
		<p><strong>Email:</strong> <?php pr($email) ?></p>
		<p><strong>Phone:</strong> <?php pr($phone) ?></p>
	</div>
	<p>Thank you for your attention.</p>
	<p>Best regards,</p>
	<p>Healthy Homes Viet Nam Team</p>
</body>

</html>