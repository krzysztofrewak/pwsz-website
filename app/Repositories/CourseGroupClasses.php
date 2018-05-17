<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\CourseGroupClass;
use PWSZ\Models\Grade;

class CourseGroupClasses extends Repository {

	/**
	 * @return CourseGroupClass
	 */
	public function getModelClass(): string {
		return CourseGroupClass::class;
	}

	/**
	 * @param Model $grade
	 * @return array
	 */
	public function map(Model $grade): array {
		/** @var Grade $grade */
		return [
			"course_group_student_id" => $grade->course_group_student_id,
			"course_group_class_id" => $grade->course_group_class_id,
			"was_present" => $grade->was_present,
			"value" => $grade->value,
			"id" => $grade->id,
		];
	}

}
