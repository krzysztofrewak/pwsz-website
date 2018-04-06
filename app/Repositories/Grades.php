<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\Resultset\Simple;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\CourseGroup;
use PWSZ\Models\Grade;
use PWSZ\Models\SemesterCourseClass;
use PWSZ\Models\Student;
use PWSZ\Models\StudentClass;

class Grades extends Repository {

	public function getModelClass(): string {
		return Grade::class;
	}

	public function map(Model $student_group, array $class_ids = [], bool $show_full_names = false): array {
		$student = $student_group->student;
		$grades = [];

		$student_grades = $student_group->grades->toArray();

		foreach($class_ids as $class_id) {
			$grade = array_search($class_id, array_column($student_grades, "course_group_class_id"));

			$grades[] = [
				"present" => $grade !== false ? $student_grades[$grade]["was_present"] : null,
				"value" => $grade !== false ? $student_grades[$grade]["value"] : null,
			];
		}

		return [
			"number" => $student->student_no,
			"initials" => $show_full_names ? $student->name : $student->initials,
			"classes" => $grades,
		];
	}

	public function getGrades(int $course_group_id, string $student_no, bool $force_result = false): array {
        $group = CourseGroup::findFirst($course_group_id);

		$result = [];
		$validation_guard = false;
		
		if(!$force_result) {
			$validation_guard = $group->getStudents(["student_no = :no:", "bind" => ["no" => $student_no]])->count();
		}

		if($force_result || $validation_guard) {
			$result["classes"] = [];
			$class_ids = [];
			foreach($group->classes as $class) {
				$result["classes"][] = $this->mapClasses($class);
				$class_ids[] = $class->id;
			}

			$result["students"] = [];

			foreach($group->groupStudents as $student) {
				$result["students"][] = $this->map($student, $class_ids, $force_result);
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
