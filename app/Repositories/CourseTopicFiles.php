<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\CourseTopicFile;

class CourseTopicFiles extends Repository {

	public function getModelClass(): string {
		return CourseTopicFile::class;
	}

	public function map(Model $model): array {
		return [
			"id" => $model->id,
			"icon" => $model->icon,
			"url" => $model->url,
			"course_topic_id" => $model->course_topic_id,
		];
	}

}
