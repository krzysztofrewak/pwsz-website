<?php

namespace PWSZ\Controllers\Management\CRUD;

use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;
use PWSZ\Models\Student;

/**
 * @property Student $model
 */
class StudentController extends CRUDController {

	/**
	 * @var string
	 */
	protected $repository_name = "students";

	/**
	 * @return string
	 */
	public function getTableTitle(): string {
		return "Studenci";
	}

	/**
	 * @return array
	 */
	public function getTableColumnHeaders(): array {
		return [
			"student_no" => "numer indeksu", 
			"initials" => "inicjały",
			"first_name" => "imię",
			"last_name" => "nazwisko",
		];
	}

	/**
	 * @return string
	 */
	public function getFormTitle(): string {
		return "Edytujesz studenta: " . $this->model->name;
	}

	/**
	 * @return array
	 */
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
