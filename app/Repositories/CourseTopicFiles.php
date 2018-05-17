<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\CourseTopicFile;

class CourseTopicFiles extends Repository {

	/**
	 * @return CourseTopicFile
	 */
	public function getModelClass(): string {
		return CourseTopicFile::class;
	}

	/**
	 * @param Model $file
	 * @return array
	 */
	public function map(Model $file): array {
		/** @var CourseTopicFile $file */
		return [
			"id" => $file->id,
			"icon" => $file->icon,
			"url" => $file->url,
			"course_topic_id" => $file->course_topic_id,
		];
	}

}
