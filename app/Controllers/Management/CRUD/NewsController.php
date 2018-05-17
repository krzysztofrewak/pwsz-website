<?php

namespace PWSZ\Controllers\Management\CRUD;

use Carbon\Carbon;
use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;
use PWSZ\Models\News;

/**
 * @property News $model
 */
class NewsController extends CRUDController {

	/**
	 * @var string
	 */
	protected $repository_name = "news";

	/**
	 * @return string
	 */
	public function getTableTitle(): string {
		return "Aktualności";
	}

	/**
	 * @return array
	 */
	public function getTableColumnHeaders(): array {
		return [
			"title" => "tytuł",
			"publication" => "opublikowano",
			"timestamp" => "dokładny czas",
		];
	}

	/**
	 * @return string
	 */
	public function getFormTitle(): string {
		return "Edytujesz news: " . $this->model->title;
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
				->setLabel("Tytuł")
				->setName("title")
				->setValue(function() use($model) { return $model->title; })
				->get(),
			FormInput::setType("description-input")
				->setLabel("Treść")
				->setName("content")
				->setValue(function() use($model) { return $model->content; })
				->get(),
			FormInput::setType("text-input")
				->setLabel("Data")
				->setName("created_at")
				->setValue(function() use($model) { return $model->created_at ?: Carbon::now()->format("Y-m-d h:i:s"); })
				->get(),
		];
	}

}
