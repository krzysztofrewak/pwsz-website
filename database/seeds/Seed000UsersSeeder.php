<?php

use Phalcon\Security;

class Seed000UsersSeeder extends AbstractSeeder {

	public function getTableName(): string {
		return "users";
	}

	public function getData(): array {
		$security = new Security();
		$security->setWorkFactor(12);

		return [
			[
				"id" => "1",
				"login" => "krewak",
				"email" => "krzysztof@rewak.pl",
				"password" => $security->hash("secret"),
			],
		];
	}
}
