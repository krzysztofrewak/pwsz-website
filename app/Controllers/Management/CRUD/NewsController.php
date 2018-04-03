<?php

namespace PWSZ\Controllers\Management\CRUD;

use Carbon\Carbon;
use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;

class NewsController extends CRUDController {

	protected $repository_name = "news";

	public function getTableTitle(): string {
		return "Aktualności";
	}
	public function getTableColumnHeaders(): array {
		return [
			"title" => "tytuł",
			"publication" => "opublikowano",
			"timestamp" => "dokładny czas",
		];
	}

	public function getFormTitle(): string {
		return "Edytujesz news: " . $this->model->title;
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
