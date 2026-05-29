<?php
function setFlashMsg($type, $msg) {
	$html = '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">';	
	$html .= $msg;
	$html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
	$html .= '<span aria-hidden="true">&times;</span>';
	$html .= '</button>';
	$html .= '</div>';

	return $html;
}

function prImg ($img) {
	echo base_url(IMG_ROOT_DIR.$img);
}

function pr($txt) {
	echo htmlspecialchars($txt);
}

function prUrl($url) {
	echo base_url($url);
}

function convertLinksToAnchors($text) {
    // Regular expression to match URLs
    $pattern = '/(https?:\/\/[^\s]+)/i';
    
    // Replace URLs with <a> tags
    $textWithLinks = preg_replace($pattern, '<a href="$1" target="_blank">$1</a>', $text);
    
    return $textWithLinks;
}

/**
 * Verify reCAPTCHA response
 * @param string $recaptchaResponse
 * @return bool
 */
function verifyRecaptcha($recaptchaResponse)
{
	$url = CAPTCHA_VERIFY_URL;
	$data = [
		'secret' => CAPTCHA_SECRET_KEY,
		'response' => $recaptchaResponse
	];

	$options = [
		'http' => [
			'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
			'method' => 'POST',
			'content' => http_build_query($data),
		],
	];
	$context = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	$jsonResult = json_decode($result, true);

	return $jsonResult['success'] ?? false;
}