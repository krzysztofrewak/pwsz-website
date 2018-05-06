<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\Resultset\Simple;
use PWSZ\Helpers\DateTimeTranslator;
use PWSZ\Helpers\NumberToRoman;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\Course;

class Courses extends Repository {

	protected function getObjects(): Simple {
		return $this->getModelClass()::find(["order" => "is_active DESC, semester_no ASC, name ASC"]);
	}

	public function getModelClass(): string {
		return Course::class;
	}

	public function map(Model $model): array {
		return [
			"id" => $model->id,
			"active" => (bool) $model->is_active,
			"index" => $model->index,
			"name" => $model->name,
			"field" => $model->field->index,
			"semester_no" => NumberToRoman::transform($model->semester_no),
			"form" => $model->form->name,
		];
	}

	protected function mapExtended($model): array {
		$topics = [];
		$last_updated = null;

		foreach($model->topics as $topic) {
			$files = [];

			foreach($topic->files as $file) {
				$files[] = [
					"id" => $file->id,
					"icon" => $file->icon,
					"url" => $file->url,
				];

				if($file->updated_at > $last_updated) {
					$last_updated = $file->updated_at;
				}
			}

			$topics[] = [
				"id" => $topic->id,
				"no" => $topic->no,
				"title" => $topic->title,
				"files" => $files,
			];

			if($topic->updated_at > $last_updated) {
				$last_updated = $topic->updated_at;
			}
		}

		return [
			"id" => $model->id,
			"name" => $model->name,
			"field" => $model->field->index,
			"semester_no" => NumberToRoman::transform($model->semester_no),
			"form" => $model->form->index,
			"description" => $model->description,
			"last_updated" => DateTimeTranslator::getDateForHuman($last_updated),
			"topics" => $topics,
		];
	}

}
