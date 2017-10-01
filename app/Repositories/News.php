<?php

namespace PWSZ\Repositories;

use PWSZ\Helpers\DateTimeTranslator;
use PWSZ\Models\News as NewsModel;

class News extends Repository {

	public function getModelClass(): string {
		return NewsModel::class;
	}

	public function map($model): array {
		return [
			"id" => $model->id,
			"title" => $model->title,
			"timestamp" => DateTimeTranslator::getDateForHuman($model->created_at),
			"content" => $model->content
		];
	}

}
