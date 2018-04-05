<?php

namespace PWSZ\Behat;

use Behat\Behat\Context\Context as ContextInterface;
use Dotenv\Dotenv;

class Context implements ContextInterface {

	public function __construct() {
		defined("APP_PATH") || define("APP_PATH", realpath("."));

		$dotenv = new Dotenv(APP_PATH);
		$dotenv->load();
	}

}
