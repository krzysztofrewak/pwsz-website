<?php

namespace PWSZ\Controllers\Management;

class FormController extends Controller {

	protected $repository_name = "forms";

	public function getTableTitle(): string {
		return "Formy zajęć";
	}
	public function getTableColumnHeaders(): array {
		return [
			"index" => "skrótowiec", 
			"name" => "nazwa",
		];
	}

	public function getFormTitle(): string {
		return "Edytujesz formę zajęć: " . $this->model->name;
	}

	public function getFormInputs(): array {
		return [
			[	"type" => "disabled-input",
				"label" => "ID",
				"name" => "id",
				"value" => $this->model->id
			],
			[	"type" => "text-input",
				"label" => "Skrót",
				"name" => "index",
				"value" => $this->model->index
			],
			[	"type" => "text-input",
				"label" => "Nazwa",
				"name" => "name",
				"value" => $this->model->name
			],
		];
	}

}
