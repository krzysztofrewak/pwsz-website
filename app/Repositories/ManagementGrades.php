<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\CourseGroupClass;
use PWSZ\Models\CourseGroupStudent;
use PWSZ\Models\Grade;

class ManagementGrades extends Grades {

	/**
	 * @param Model $student_group
	 * @param array $class_ids
	 * @param bool $show_full_names
	 * @return array
	 */
	public function map(Model $student_group, array $class_ids = [], bool $show_full_names = false): array {
		/** @var CourseGroupStudent $student_group */
		$student = $student_group->student;
		$grades = [];

		$student_grades = $student_group->grades->toArray();

		foreach($class_ids as $class_id) {
			$grade = array_search($class_id, array_column($student_grades, "course_group_class_id"));

			$grades[] = [
				"course_group_student_id" => $grade !== false ? $student_grades[$grade]["course_group_student_id"] : null,
				"course_group_class_id" => $grade !== false ? $student_grades[$grade]["course_group_class_id"] : null,
				"was_present" => $grade !== false ? $student_grades[$grade]["was_present"] : null,
				"value" => $grade !== false ? $student_grades[$grade]["value"] : null,
				"id" => $grade !== false ? $student_grades[$grade]["id"] : null,
			];
		}

		return [
			"id" => $student->id,
			"number" => $student->student_no,
			"name" => $student->name,
			"classes" => $grades,
		];
	}

	/**
	 * @param Model $class
	 * @return array
	 */
	protected function mapClasses(Model $class): array {
		/** @var CourseGroupClass $class */
		return [
			"id" => $class->id,
			"name" => $class->name,
			"course_group_id" => $class->course_group_id,
		];
	}

	/**
	 * @param array $students
	 * @return array
	 */
	protected function sortStudents(array $students): array {
		usort($students, function($a, $b) {
			return explode(" ", $a["name"])[1] > explode(" ", $b["name"])[1];
		});

		return $students;
	}

	/**
	 * @param array $students
	 * @param string $student_no
	 * @return array
	 */
	protected function obfuscateStudents(array $students, string $student_no): array {
		return $students;
	}

}