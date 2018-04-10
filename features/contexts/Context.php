<?php

namespace PWSZ\Tests;

use Behat\Behat\Context\Context as ContextInterface;
use Behat\Behat\Hook\Scope\BeforeFeatureScope;
use Dotenv\Dotenv;
use Phalcon\Mvc\Application;
use PWSZ\Models\User;

class Context implements ContextInterface {

	protected static $di;

	public static function getDI() {
		defined("APP_PATH") || define("APP_PATH", realpath("."));

		require_once APP_PATH . "/vendor/autoload.php";

		$config = include APP_PATH . "/app/config.php";
		return include APP_PATH . "/app/services.php";
	}

	/** @BeforeFeature @auth */
	public static function setAuthenticatedSession() {
		self::$di = self::getDI();

		$user = User::findFirst(1);
		self::$di->get("session")->set("auth", $user);
	}

	/** @BeforeFeature @guest */
	public static function setUnauthenticatedSession() {
		self::$di = self::getDI();
		self::$di->get("session")->remove("auth");
	}

}
