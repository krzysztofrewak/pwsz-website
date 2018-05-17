<?php

class Seed001FieldsSeeder extends AbstractSeeder {

	/**
	 * @return string
	 */
	public function getTableName(): string {
		return "fields";
	}

	/**
	 * @return array
	 */
	public function getData(): array {
		return [
			[
				"id" => "1",
				"index" => "INF",
				"name" => "kierunek Informatyka",
			],
			[
				"id" => "2",
				"index" => "INF/SSK",
				"name" => "specjalność Systemy i sieci komputerowe",
			],
			[
				"id" => "3",
				"index" => "INF/PAM",
				"name" => "specjalność Programowanie aplikacji mobilnych i internetowych",
			],
		];
	}
}
