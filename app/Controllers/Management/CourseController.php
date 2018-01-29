<?php

namespace PWSZ\Controllers\Management;

class CourseController extends Controller {

	protected $repository_name = "courses";

	public function getTableTitle(): string {
		return "Kursy";
	}
	public function getTableColumnHeaders(): array {
		return [
			"index" => "#",
			"name" => "nazwa",
			"field" => "kier./spec.",
			"semester_no" => "semestr",
			"form" => "forma",
			"active" => "aktywny?",
		];
	}

	public function getFormTitle(): string {
		return "Edytujesz kurs: " . $this->model->name;
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
