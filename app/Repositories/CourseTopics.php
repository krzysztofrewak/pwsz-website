<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\CourseTopic;

class CourseTopics extends Repository {

	public function getModelClass(): string {
		return CourseTopic::class;
	}

	public function map(Model $model): array {
		return [
			"id" => $model->id,
			"course_id" => $model->course_id,
			"no" => $model->no,
			"title" => $model->title,
		];
	}

}
