<?php

namespace PWSZ\Controllers\Management\CRUD;

use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;

class FaqController extends CRUDController {

	protected $repository_name = "faqs";

	public function getTableTitle(): string {
		return "Pytania i odpowiedzi";
	}
	public function getTableColumnHeaders(): array {
		return [
			"question" => "pytanie",
		];
	}

	public function getFormTitle(): string {
		return "Edytujesz pytanie #" . $this->model->id;
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
				->setLabel("Pytanie")
				->setName("question")
				->setValue(function() use($model) { return $model->question; })
				->get(),
			FormInput::setType("description-input")
				->setLabel("Odpowiedź")
				->setName("answer")
				->setValue(function() use($model) { return $model->answer; })
				->get(),
		];
	}

}
