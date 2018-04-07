<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\CourseGroupClass;

class CourseGroupClasses extends Repository {

	public function getModelClass(): string {
		return CourseGroupClass::class;
	}

	public function map(Model $model): array {
		return [
			"course_group_student_id" => $model->course_group_student_id,
			"course_group_class_id" => $model->course_group_class_id,
			"was_present" => $model->was_present,
			"value" => $model->value,
			"id" => $model->id,
		];
	}

}
