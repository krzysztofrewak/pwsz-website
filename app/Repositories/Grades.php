<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\CourseGroup;
use PWSZ\Models\StudentClass;
use PWSZ\Models\Student;
use PWSZ\Models\SemesterCourseClass;

class Grades extends Repository {

	public function getModelClass(): string {
		return CourseGroup::class;
	}

	public function map(Model $model, bool $show_full_names = false): array {
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
			"initials" => $show_full_names ? $student->name : $student->initials,
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
				$result["classes"][] = $this->mapClasses($class);
			}

			$result["students"] = [];
			foreach($course_group->groupStudents as $student) {
				$result["students"][] = $this->map($student, $force_result);
			}

			$result["students"] = $this->sortStudents($result["students"]);
		}
		
		return $result;
	}

	protected function mapClasses(Model $class): array {
		return ["name" => $class->name];
	}

	protected function sortStudents(array $students): array {
		usort($students, function($a, $b) {
			return $a["number"] - $b["number"];
		});

		return $students;
	}

}
