<?php

namespace PWSZ\Controllers\Management;

class SemesterController extends Controller {

	protected $repository_name = "semesters";

	public function getTableTitle(): string {
		return "Semestry";
	}
	public function getTableColumnHeaders(): array {
		return [
			"name" => "nazwa",
		];
	}

	public function getFormTitle(): string {
		return "Edytujesz semestr: " . $this->model->name;
	}

	public function getFormInputs(): array {
		return [
			[	"type" => "disabled-input",
				"label" => "ID",
				"name" => "id",
				"value" => $this->model->id
			],
			[	"type" => "text-input",
				"label" => "Nazwa",
				"name" => "name",
				"value" => $this->model->name
			],
		];
	}

}
