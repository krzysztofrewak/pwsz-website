<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\ResultsetInterface;
use PWSZ\Helpers\DateTimeTranslator;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\News as NewsModel;

class News extends Repository {

	/**
	 * @return ResultsetInterface
	 */
	protected function getObjects(): ResultsetInterface {
		return $this->getModelClass()::find(["order" => "created_at DESC"]);
	}

	/**
	 * @return NewsModel
	 */
	public function getModelClass(): string {
		return NewsModel::class;
	}

	/**
	 * @param Model $news
	 * @return array
	 */
	public function map(Model $news): array {
		/** @var NewsModel $news */
		return [
			"id" => $news->id,
			"title" => $news->title,
			"timestamp" => $news->created_at,
			"publication" => DateTimeTranslator::getDateForHuman($news->created_at),
			"content" => $news->content
		];
	}

}
