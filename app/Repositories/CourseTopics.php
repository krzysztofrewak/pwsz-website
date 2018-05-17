<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\CourseTopic;

class CourseTopics extends Repository {

	/**
	 * @return CourseTopic
	 */
	public function getModelClass(): string {
		return CourseTopic::class;
	}

	/**
	 * @param Model $topic
	 * @return array
	 */
	public function map(Model $topic): array {
		/** @var CourseTopic $topic */
		return [
			"id" => $topic->id,
			"course_id" => $topic->course_id,
			"no" => $topic->no,
			"title" => $topic->title,
		];
	}

}
