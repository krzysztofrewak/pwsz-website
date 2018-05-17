<?php

namespace PWSZ\Controllers\Management\CRUD;

use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;
use PWSZ\Models\Semester;

/**
 * @property Semester $model
 */
class SemesterController extends CRUDController {

	/**
	 * @var string
	 */
	protected $repository_name = "semesters";

	/**
	 * @return string
	 */
	public function getTableTitle(): string {
		return "Semestry";
	}

	/**
	 * @return array
	 */
	public function getTableColumnHeaders(): array {
		return [
			"name" => "nazwa",
		];
	}

	/**
	 * @return string
	 */
	public function getFormTitle(): string {
		return "Edytujesz semestr: " . $this->model->name;
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
				->setLabel("Nazwa")
				->setName("name")
				->setValue(function() use($model) { return $model->name; })
				->get(),
		];
	}

}
