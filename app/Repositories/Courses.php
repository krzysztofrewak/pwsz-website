<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\ResultsetInterface;
use PWSZ\Helpers\DateTimeTranslator;
use PWSZ\Helpers\NumberToRoman;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\Course;

class Courses extends Repository {

	/**
	 * @return ResultsetInterface
	 */
	protected function getObjects(): ResultsetInterface {
		return $this->getModelClass()::find(["order" => "is_active DESC, semester_no ASC, name ASC"]);
	}

	/**
	 * @return Course
	 */
	public function getModelClass(): string {
		return Course::class;
	}

	/**
	 * @param Model $course
	 * @return array
	 */
	public function map(Model $course): array {
		/** @var Course $course */
		return [
			"id" => $course->id,
			"active" => (bool) $course->is_active,
			"index" => $course->index,
			"name" => $course->name,
			"field" => $course->field->index,
			"semester_no" => NumberToRoman::transform($course->semester_no),
			"form" => $course->form->name,
		];
	}

	/**
	 * @param $model
	 * @return array
	 */
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
