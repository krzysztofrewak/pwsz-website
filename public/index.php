<?php

use Phalcon\Mvc\Application;
use PWSZ\Helpers\ResponseArray;
use Whoops\Provider\Phalcon\WhoopsServiceProvider as Whoops;

require_once "../app/bootstrap.php";

$bootstrap = getBootstrap();
$config = $bootstrap["config"];
$di = $bootstrap["di"];

$application = new Application($di);

if($config->application->environment == "dev") {
	error_reporting(E_ALL);
	new Whoops($di);
}

echo $application->handle()->getContent();
