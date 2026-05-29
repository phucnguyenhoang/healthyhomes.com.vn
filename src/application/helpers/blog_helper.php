<?php
function limitText($text, $limit) {
	$arrTxt = explode(' ', $text);
	$newTxt = '';
  	if (sizeof($arrTxt) > $limit) {
      	for ($i=0; $i<$limit; $i++) {
      		$newTxt = $newTxt.$arrTxt[$i].' ';
      	}
      	$newTxt = $newTxt.'...';
  	} else {
  		$newTxt = $text;
  	}
  	return $newTxt;
}

function countWord($text) {
    $arrTxt = explode(' ', $text);
    return sizeof($arrTxt);
}