<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';
require 'pusher-php-server/lib/Pusher.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, and `Slim::delete`
 * is an anonymous function.
 */

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
	$filename = "./status.txt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	echo $contents;
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
