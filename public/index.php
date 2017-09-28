<?php

use Phalcon\Mvc\Application;
use Whoops\Provider\Phalcon\WhoopsServiceProvider as Whoops;

error_reporting(E_ALL);

define("APP_PATH", realpath(".."));

require_once APP_PATH . "/vendor/autoload.php";

$config = include APP_PATH . "/app/config.php";
$di = include APP_PATH . "/app/services.php";

$application = new Application($di);

if($config->application->environment == "dev") {
	new Whoops($di);
}

echo $application->handle()->getContent();
