<?php

class Seed003SemestersSeeder extends AbstractSeeder {

	public function getTableName(): string {
		return "semesters";
	}

	public function getData(): array {
		return [
			[
				"id" => "1",
				"name" => "zimowy 2017/18",
			],
		];
	}
}
