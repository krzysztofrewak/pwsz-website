<?php

namespace PWSZ\Repositories;

use PWSZ\Helpers\NumberToRoman;
use PWSZ\Models\Course;

class Courses extends Repository {

	public function getModelClass(): string {
		return Course::class;
	}

	public function map($model): array {
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

		foreach($model->topics as $topic) {
			$files = [];

			foreach($topic->files as $file) {
				$files[] = [
					"icon" => $file->icon,
					"url" => $file->url,
				];
			}

			$topics[] = [
				"no" => $topic->no,
				"title" => $topic->title,
				"language" => $topic->language,
				"files" => $files,
			];
		}

		return [
			"id" => $model->id,
			"name" => $model->name,
			"field" => $model->field->index,
			"semester_no" => NumberToRoman::transform($model->semester_no),
			"form" => $model->form->index,
			"rules" => $model->rules,
			"topics" => $topics,
		];
	}

}
