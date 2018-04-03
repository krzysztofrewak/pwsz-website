<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\Resultset\Simple;
use PWSZ\Helpers\DateTimeTranslator;
use PWSZ\Models\News as NewsModel;

class News extends Repository {

	protected function getObjects(): Simple {
		return $this->getModelClass()::find(["order" => "created_at DESC"]);
	}

	public function getModelClass(): string {
		return NewsModel::class;
	}

	public function map($model): array {
		return [
			"id" => $model->id,
			"title" => $model->title,
			"timestamp" => $model->created_at,
			"publication" => DateTimeTranslator::getDateForHuman($model->created_at),
			"content" => $model->content
		];
	}

}
