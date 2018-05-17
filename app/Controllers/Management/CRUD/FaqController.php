<?php

namespace PWSZ\Controllers\Management\CRUD;

use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;
use PWSZ\Models\Faq;

/**
 * @property Faq $model
 */
class FaqController extends CRUDController {

	/**
	 * @var string
	 */
	protected $repository_name = "faqs";

	/**
	 * @return string
	 */
	public function getTableTitle(): string {
		return "Pytania i odpowiedzi";
	}

	/**
	 * @return array
	 */
	public function getTableColumnHeaders(): array {
		return [
			"question" => "pytanie",
		];
	}

	/**
	 * @return string
	 */
	public function getFormTitle(): string {
		return "Edytujesz pytanie #" . $this->model->id;
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
