<?php

namespace PWSZ\Controllers\Management\CRUD;

use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;

class SemesterController extends CRUDController {

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
		$model = $this->model;

		return [
			FormInput::setType("disabled-input")
				->setLabel("ID")
				->setName("id")
				->setValue(function() use($model) { return $model->id; })
				->get(),
			FormInput::setType("text-input")
				->setLabel("Nazwa")
				->setName("name")
				->setValue(function() use($model) { return $model->name; })
				->get(),
		];
	}

}
