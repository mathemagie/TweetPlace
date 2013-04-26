<?php
require 'Slim/Slim.php';
require 'pusher-php-server-master/lib/Pusher.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app_id = '41686';
$app_key = '15b20d20432e58d9debf';
$app_secret = '4c8b190a15aacda94b7c';
$pusher = new Pusher( $app_key, $app_secret, $app_id );

// GET route
$app->get('/', function () {
    $template = <<<EOT
API la-tapisserie.net 
EOT;
    echo $template;
});

$app->get('/status', function () {
	header("Access-Control-Allow-Origin: *");
	$filename = "./status.txt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	$arr = array('open' => $contents);
    echo json_encode($arr);

	//echo $contents;
	fclose($handle);
});

// POST route
$app->post('/s', function () {
	global $pusher;

	$filename = "./status.txt";
	$handle = fopen($filename, "r");
	$current_status = fread($handle, filesize($filename));
	fclose($handle);
	$new_status = $_POST['status'];

	if (1) {
		if ($new_status != $current_status) {//send push only a on new status
			$pusher->trigger( 'tapisserie', 'is_open', $new_status );
		}
		$fp = fopen('./status.txt', 'w+');
		fwrite($fp, $new_status);
		fclose($fp);
		 echo 'Set status for la tapisserie : ' . $new_status;
	  }
});

$app->run();
