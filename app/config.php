<?php

use Carbon\Carbon;
use Dotenv\Dotenv;
use Phalcon\Config;

defined("APP_PATH") || define("APP_PATH", realpath("."));

$dotenv = new Dotenv(APP_PATH);
$dotenv->load();

Carbon::setLocale("pl");

return new Config([
	"application" => [
		"environment" => strtolower(getenv("ENV")),
		"publicDir" => APP_PATH . "/public/",
		"baseUri" => "/",
		"imagesUri" => "/images/",
	],
	"database" => [
		"host" => getenv("DATABASE_HOST"),
		"username" => getenv("DATABASE_USERNAME"),
		"password" => getenv("DATABASE_PASSWORD"),
		"name" => getenv("DATABASE_NAME"),
	],
]);
