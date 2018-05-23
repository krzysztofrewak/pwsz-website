<?php

use Carbon\Carbon;
use Dotenv\Dotenv;
use Phalcon\Config;

defined("APP_PATH") || define("APP_PATH", realpath("."));
defined("ENV_FILENAME") || define("ENV_FILENAME", ".env");

$env = new Dotenv(APP_PATH, ENV_FILENAME);
$env->load();

Carbon::setLocale(getenv("APP_LOCALE", "pl"));
date_default_timezone_set(getenv("APP_TIMEZONE", "Europe/Warsaw"));

return new Config([
	"application" => [
		"environment" => strtolower(getenv("APP_ENV")),
		"publicDir" => APP_PATH . "/public/",
		"baseUri" => "/",
		"imagesUri" => "/images/",
	],
	"database" => [
		"host" => getenv("DATABASE_HOST"),
		"port" => getenv("DATABASE_PORT"),
		"username" => getenv("DATABASE_USERNAME"),
		"password" => getenv("DATABASE_PASSWORD"),
		"name" => getenv("DATABASE_NAME"),
	],
]);
