<?php

namespace PWSZ\Repositories;

use PWSZ\Exceptions\NotFound;
use PWSZ\Interfaces\GradesRepositoryInterface;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\CourseGroup;
use PWSZ\Models\CourseGroupClass;
use PWSZ\Models\CourseGroupStudent;
use PWSZ\Models\Grade;

class Grades extends Repository implements GradesRepositoryInterface {

	/**
	 * @return Grade
	 */
	public function getModelClass(): string {
		return Grade::class;
	}

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
				"present" => $grade !== false ? $student_grades[$grade]["was_present"] : null,
				"value" => $grade !== false ? $student_grades[$grade]["value"] : null,
			];
		}

		return [
			"number" => $student->student_no,
			"classes" => $grades,
		];
	}

	/**
	 * @param int $course_group_id
	 * @param string $student_no
	 * @param bool $force_result
	 * @return array
	 * @throws NotFound
	 */
	public function getGrades(int $course_group_id, string $student_no, bool $force_result = false): array {
		/** @var CourseGroup $group */
		$group = CourseGroup::findFirst($course_group_id);

		if(!$group) {
			throw new NotFound();
		}

		$result = [];
		$validation_guard = false;
		
		if(!$force_result) {
			$validation_guard = $group->getStudents(["student_no = :no:", "bind" => ["no" => $student_no]])->count();
		}

		if($force_result || $validation_guard) {
			$result["classes"] = [];
			$class_ids = [];

			/** @var CourseGroupClass $class */
			foreach($group->classes as $class) {
				$result["classes"][] = $this->mapClasses($class);
				$class_ids[] = $class->id;
			}

			$result["students"] = [];

			/** @var CourseGroupStudent $student */
			foreach($group->groupStudents as $student) {
				$result["students"][] = $this->map($student, $class_ids, $force_result);
			}

			$result["students"] = $this->sortStudents($result["students"]);
			$result["students"] = $this->obfuscateStudents($result["students"], $student_no);
		}
		
		return $result;
	}

	/**
	 * @param Model $class
	 * @return array
	 */
	protected function mapClasses(Model $class): array {
		/** @var CourseGroupClass $class */
		return ["name" => $class->name];
	}

	/**
	 * @param array $students
	 * @return array
	 */
	protected function sortStudents(array $students): array {
		shuffle($students);
		return $students;
	}

	/**
	 * @param array $students
	 * @param string $student_no
	 * @return array
	 */
	protected function obfuscateStudents(array $students, string $student_no): array {
		return array_map(function(array $student) use($student_no): array {
			if($student_no !== $student["number"]) {
				$student["number"] = "";
			}
			return $student;
		}, $students);
	}

}
