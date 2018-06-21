<?php

namespace PWSZ\Controllers\Management\CRUD;

use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;
use PWSZ\Models\Mode;

/**
 * @property Mode $model
 */
class ModeController extends CRUDController {

	/**
	 * @var string
	 */
	protected $repository_name = "modes";

	/**
	 * @return string
	 */
	public function getTableTitle(): string {
		return "Tryby studiów";
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
		return "Edytujesz tryb studiów: " . $this->model->name;
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
