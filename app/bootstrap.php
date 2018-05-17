<?php

/**
 * @param string $path
 * @param string $env_filename
 * @return array
 */
function getBootstrap(string $path = "..", string $env_filename = ".env"): array {
	defined("APP_PATH") || define("APP_PATH", realpath($path));
	defined("ENV_FILENAME") || define("ENV_FILENAME", $env_filename);

	require_once APP_PATH . "/vendor/autoload.php";

	$config = include APP_PATH . "/app/config.php";
	$di = include APP_PATH . "/app/services.php";

	return [
		"config" => $config,
		"di" => $di,
	];
}
