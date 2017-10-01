<?php

class Seed002FormsSeeder extends AbstractSeeder {

	public function getTableName(): string {
		return "forms";
	}

	public function getData(): array {
		return [
			[
				"id" => "1",
				"index" => "W",
				"name" => "wykład",
			],
			[
				"id" => "2",
				"index" => "C",
				"name" => "ćwiczenia",
			],
			[
				"id" => "3",
				"index" => "L",
				"name" => "laboratorium",
			],
			[
				"id" => "4",
				"index" => "P",
				"name" => "projekt",
			],
			[
				"id" => "5",
				"index" => "S",
				"name" => "seminarium",
			],
		];
	}
}
