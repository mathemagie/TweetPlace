<?php

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
		 echo htmlentities($tmhOAuth->response['response']);
		return TRUE;
	} else {
	// En cours de dév, afficher les informations retournées :
		echo htmlentities($tmhOAuth->response['response']);
		return FALSE;
	}
}
?>