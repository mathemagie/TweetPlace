<?php
require 'Slim/Slim.php';
require 'pusher-php-server-master/lib/Pusher.php';
require 'api_class.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app_id = '41686';
$app_key = '15b20d20432e58d9debf';
$app_secret = '4c8b190a15aacda94b7c';
$pusher = new Pusher( $app_key, $app_secret, $app_id );

// GET route
$app->get('/', function () {
    $template = <<<EOT
API la-tapisserie.net <br/><br/>

<a href="/v1/open">La Tapisserie est-elle ouverte ? oui/non </a><br><br/>
<a href="/rideau/index.html">Le fameux rideau :)</a><br><br/>
<a href="/lieu.php">Sur Google Map</a><br><br/>
EOT;
    echo $template;
});

$app->get('/v1/open', function () {
	header("Access-Control-Allow-Origin: *");
	$current_status = get_current_status();
	$arr = array('open' => rtrim($current_status));
    echo json_encode($arr);
});

// POST route
$app->post('/s', function () {
	global $pusher;

	$current_status = get_current_status();
	$new_status = $_POST['status'];

	$st = intval($new_status);
	$tweet_message = get_message_to_tweet($st);
	if (0) $s = tweet( addslashes($tweet_message));

//	$s = tweet( time() . ' = la_tapisserie status : ' . $new_status);

	if ($new_status != $current_status) {//send push only a on new status
		$pusher->trigger( 'tapisserie', 'is_open', $new_status );
	}
	set_current_status($new_status);
	echo 'Set status for la tapisserie : ' . $new_status;
});

$app->run();
