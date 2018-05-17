<?php

namespace PWSZ\Controllers\Management\CRUD;

use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;
use PWSZ\Models\Field;

/**
 * @property Field $model
 */
class FieldController extends CRUDController {

	/**
	 * @var string
	 */
	protected $repository_name = "fields";

	/**
	 * @return string
	 */
	public function getTableTitle(): string {
		return "Kierunki i specjalności";
	}

	/**
	 * @return array
	 */
	public function getTableColumnHeaders(): array {
		return [
			"index" => "skrótowiec", 
			"name" => "nazwa",
		];
	}

	/**
	 * @return string
	 */
	public function getFormTitle(): string {
		return "Edytujesz kierunek/specjalność: " . $this->model->name;
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
				->setLabel("Skrót")
				->setName("index")
				->setValue(function() use($model) { return $model->index; })
				->get(),
			FormInput::setType("text-input")
				->setLabel("Nazwa")
				->setName("name")
				->setValue(function() use($model) { return $model->name; })
				->get(),
		];
	}

}
