<?php

namespace PWSZ\Tests;

use Behat\Behat\Context\Context as ContextInterface;
use Phalcon\DiInterface;
use PWSZ\Tests\Traits\BeforeFeatures;

class Context implements ContextInterface {

	use BeforeFeatures;

	/**
	 * @var DiInterface
	 */
	protected static $di;

	const TEST_LOG_FILNAME = "./logs/test.log";

	/**
	 * @return DiInterface
	 */
	public static function getDI(): DiInterface {
		require_once "./app/bootstrap.php";
		return getBootstrap(".", ".env.behat")["di"];
	}

}
