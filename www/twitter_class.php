<?php

function get_message_to_tweet($status) {

	$open[] = 'Ohlalala, la Tapisserie est “ouverte” et il y a plein de chips à manger.';
	$open[] = 'Ohlalala, la Tapisserie est “ouverte” à cette heure incongrue. Qu’on se le dise';
	$open[] = 'Ohlalala, la Tapisserie est “ouverte” et les bulles nous manquent. Perrier ou Champagne are welcome!';

	$close[] = 'Ohlalala, la Tapisserie est “fermée” et il y a plus de chips à manger.';
	$close[] = 'Ohlalala, la Tapisserie est “fermée” à cette heure incongrue. Qu’on se le dise.';
	$close[] = 'Ohlalala, la Tapisserie est “fermée” et les bulles nous manquent. Plus de Perrier ou Champagne.';

	if ($status) {
		$r = rand(0,count($open) - 1);
		return $open[$r];
	}else {
		$r = rand(0,count($close) - 1);
		return $close[$r];
	}
}

function tweet($message) {
	require 'tmhOAuth/tmhOAuth.php';
	$tmhOAuth = new tmhOAuth(array(
		'consumer_key' => 'oLUQQ7r5TGcASRQL9P3Sng',
		'consumer_secret' => 'OGBFzrpf00kGMvqDE68Vq3iLg2igH12TNz8F9oiwlBY',
		'user_token' => '891254569-94LQXatr1T6i6us8RIFpb0qvEZL772Y1AOmCTeY6',
		'user_secret' => 'e27Ay7Wbq0u7tdnCTLEuAHaeHxwebIHWQJzh1VjWDo',
	));
 
	$tmhOAuth->request('POST', $tmhOAuth->url('1.1/statuses/update'), array(
		'status' => utf8_encode($message)
	));
 
	if ($tmhOAuth->response['code'] == 200) {
	// En cours de dév, afficher les informations retournées :
		 //echo htmlentities($tmhOAuth->response['response']);
		return TRUE;
	} else {
	// En cours de dév, afficher les informations retournées :
		//echo htmlentities($tmhOAuth->response['response']);
		return FALSE;
	}
}
?>