<?php

use Carbon\Carbon;
use Phalcon\Config;
use Phalcon\Db\Adapter\Pdo\Mysql as MySQLDatabaseAdapter;
use Phalcon\Di\FactoryDefault as ServiceContainer;
use Phalcon\Logger\Adapter\File as LoggerFileAdapter;
use Phalcon\Logger\Formatter\Line as TestsLoggerLineFormatter;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View;
use Phalcon\Security;
use Phalcon\Session\Adapter\Files as SessionFileAdapter;
use PWSZ\Helpers\LoggerLineFormatter;
use PWSZ\Helpers\RepositoryDispatcher;

/** @var Config $config */

$di = new ServiceContainer();

$di->set("config", function() use($config) {
	return $config;
}, true);

$di->set("db", function() use($config) {
	return new MySQLDatabaseAdapter(
		[
			"host" => $config->get("database")->host,
			"username" => $config->get("database")->username,
			"password" => $config->get("database")->password,
			"dbname" => $config->get("database")->name,
			"options" => [
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
			],
		]
	);
});

$di->Set("dispatcher", function() {
	$dispatcher = new Dispatcher();
	return $dispatcher;
}, true);

$di->set("logger", function() use($config) {
	if($config->get("application")->environment == "test") {
		$log_filename = "./logs/test.log";
		$logger = new LoggerFileAdapter($log_filename);
		$logger->setFormatter(new TestsLoggerLineFormatter("%type%"));
		
		return $logger;
	}

	$log_filename = "../logs/" . Carbon::now()->format("Y-m-d") . ".log";
	$logger = new LoggerFileAdapter($log_filename);
	$logger->setFormatter(new LoggerLineFormatter());

	return $logger;

});

$di->set("router", function() use($di) {
	$router = require APP_PATH . "/app/router.php";
	return $router;
});

$di->set("security", function() {
	$security = new Security();
	$security->setWorkFactor(12);
	return $security;
}, true);

$di->set("session", function() {
	$session = new SessionFileAdapter();
	$session->start();
	return $session;
});

$di->set("url", function() use($config) {
	$url = new UrlProvider();
	$url->setBaseUri("/");
	return $url;
});

$di->set("view", function() use($config) {
	return new View();
});

$di->set("repository", function() {
	return new RepositoryDispatcher();
});

return $di;
