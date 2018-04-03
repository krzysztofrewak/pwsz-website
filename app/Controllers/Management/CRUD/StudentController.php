<?php

namespace PWSZ\Controllers\Management\CRUD;

use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;

class StudentController extends CRUDController {

	protected $repository_name = "students";

	public function getTableTitle(): string {
		return "Studenci";
	}
	public function getTableColumnHeaders(): array {
		return [
			"student_no" => "numer indeksu", 
			"initials" => "inicjały",
			"name" => "imię",
		];
	}

	public function getFormTitle(): string {
		return "Edytujesz studenta: " . $this->model->name;
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
				->setLabel("Imię")
				->setName("name")
				->setValue(function() use($model) { return $model->name; })
				->get(),
			FormInput::setType("text-input")
				->setLabel("Numer indeksu")
				->setName("student_no")
				->setValue(function() use($model) { return $model->student_no; })
				->get(),
		];
	}

}
