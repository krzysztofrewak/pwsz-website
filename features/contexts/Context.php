<?php

namespace PWSZ\Tests;

use Behat\Behat\Context\Context as ContextInterface;
use Phalcon\DiInterface;
use Phinx\Config\Config;
use Phinx\Migration\Manager;
use PWSZ\Models\User;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;

class Context implements ContextInterface {

	protected static $di;

	public static function getDI(): DiInterface {
		require_once "./app/bootstrap.php";
		return getBootstrap(".", ".env.behat")["di"];
	}

	/** @BeforeFeature @database */
	public static function rebuildTestingDatabase(): void {
		self::$di = self::getDI();

		$db = self::$di->get("db");
		$db->execute("SET foreign_key_checks = 0");
		foreach($db->fetchAll("SHOW TABLES") as $table) {
			$table_name = $table["Tables_in_" . getenv("DATABASE_NAME")];
			$db->execute("DROP TABLE " . $table_name);
		}
		$db->execute("SET foreign_key_checks = 1");

		$phinx = require_once "./phinx.php";
		$phinx["environments"]["testing"] = [
			"adapter" => "mysql",
			"host" => getenv("DATABASE_HOST"),
			"name" => getenv("DATABASE_NAME"),
			"user" => getenv("DATABASE_USERNAME"),
			"pass" => getenv("DATABASE_PASSWORD"),
			"port" => "3306",
			"charset" => "utf8",
		];

		$manager = new Manager(new Config($phinx), new StringInput(" "), new NullOutput());

		$manager->migrate("testing");
		$manager->seed("testing");

		echo "rebuilding database";
	}

	/** @BeforeFeature @auth */
	public static function setAuthenticatedSession(): void {
		self::$di = self::getDI();

		self::$di->get("session")->set("auth", User::findFirst());

		echo "setting authenticated session";
	}

	/** @BeforeFeature @guest */
	public static function setUnauthenticatedSession(): void {
		self::$di = self::getDI();

		self::$di->get("session")->remove("auth");

		echo "setting unauthenticated session";
	}

}
