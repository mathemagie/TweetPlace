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
	if (1) {
		$fp = fopen('./status.txt', 'w+');
		fwrite($fp, $_POST['status']);
		fclose($fp);
		 echo 'Set status for la tapisserie : ' . $_POST['status'];
	  }
});

$app->run();
