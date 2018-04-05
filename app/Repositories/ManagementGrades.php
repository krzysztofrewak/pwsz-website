<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\SemesterCourseClass;

class ManagementGrades extends Grades {

	public function map(Model $model): array {
		$student = $model->student;
		$classes = [];

		foreach($model->classes as $class) {
			$classes[] = [
				"id" => $class->id,
				"present" => $class->was_present,
				"value" => $class->value,
			];
		}

		return [
			"id" => $student->id,
			"number" => $student->student_no,
			"initials" => $student->name,
			"classes" => $classes,
		];
	}

	protected function mapClasses(Model $class): array {
		return [
			"id" => $class->id,
			"name" => $class->name,
		];
	}

}
