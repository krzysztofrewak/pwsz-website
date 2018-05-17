<?php

use Phalcon\Security;

class Seed000UsersSeeder extends AbstractSeeder {

	/**
	 * @return string
	 */
	public function getTableName(): string {
		return "users";
	}

	/**
	 * @return array
	 */
	public function getData(): array {
		$security = new Security();
		$security->setWorkFactor(12);

		return [
			[
				"id" => "1",
				"login" => "admin",
				"email" => "admin@example.com",
				"password" => $security->hash("password"),
			],
		];
	}
}
