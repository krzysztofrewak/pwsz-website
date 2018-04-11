<?php

use Dotenv\Dotenv;

defined("APP_PATH") || define("APP_PATH", realpath("."));

$phinx_settings = [];

$phinx_settings["paths"] = [
	"migrations" => APP_PATH . "/database/migrations",
	"seeds" => APP_PATH . "/database/seeds",
];

$dotenv = new Dotenv(APP_PATH);
$dotenv->load();

$phinx_settings["environments"] = [
	"default_migration_table" => "migrations",
	"default_database" => "database",
	"database" => [
		"adapter" => "mysql",
		"host" => getenv("DATABASE_HOST"),
		"name" => getenv("DATABASE_NAME"),
		"user" => getenv("DATABASE_USERNAME"),
		"pass" => getenv("DATABASE_PASSWORD"),
		"port" => "3306",
		"charset" => "utf8",
	],
];

$phinx_settings["version_order"] = "creation";

return $phinx_settings;