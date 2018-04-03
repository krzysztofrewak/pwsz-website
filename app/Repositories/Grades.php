<?php

namespace PWSZ\Repositories;

use PWSZ\Models\CourseGroup;
use PWSZ\Models\StudentClass;
use PWSZ\Models\Student;

class Grades extends Repository {

	public function getModelClass(): string {
		return CourseGroup::class;
	}

	public function map($model): array {
		$student = $model->student;
		$classes = [];

		foreach($model->classes as $class) {
			$classes[] = [
				"present" => $class->was_present,
				"value" => $class->value,
			];
		}

		return [
			"number" => $student->student_no,
			"initials" => $student->initials,
			"classes" => $classes,
		];
	}

	public function getGrades(int $semester_course_group_id, string $student_no, bool $force_result = false): array {
        $course_group = $this->getModelClass()::findFirst($semester_course_group_id);

		$result = [];
		$validation_guard = false;
		
		if(!$force_result) {
			$validation_guard = $course_group->getStudents(["student_no = :no:", "bind" => ["no" => $student_no]])->count();
		}

		if($force_result || $validation_guard) {
			$result["classes"] = [];
			foreach($course_group->classes as $class) {
				$result["classes"][] = $class->name;
			}

			$result["students"] = [];
			foreach($course_group->groupStudents as $student) {
				$result["students"][] = $this->map($student);
			}

			usort($result["students"], function($a, $b) {
				return $a["number"] - $b["number"];
			});
		}
		
		return $result;
	}

}
