<?php

namespace PWSZ\Controllers\Management\CRUD;

use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;

class FieldController extends CRUDController {

	protected $repository_name = "fields";

	public function getTableTitle(): string {
		return "Kierunki i specjalności";
	}
	
	public function getTableColumnHeaders(): array {
		return [
			"index" => "skrótowiec", 
			"name" => "nazwa",
		];
	}

	public function getFormTitle(): string {
		return "Edytujesz kierunek/specjalność: " . $this->model->name;
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
