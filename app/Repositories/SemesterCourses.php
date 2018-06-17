<?php

namespace PWSZ\Repositories;

use PWSZ\Exceptions\NotFound;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\Course;
use PWSZ\Models\Semester;
use PWSZ\Models\SemesterCourse;

class SemesterCourses extends Repository {

	/**
	 * @return SemesterCourse
	 */
	public function getModelClass(): string {
		return SemesterCourse::class;
	}

	/**
	 * @param Model $course
	 * @return array
	 */
	public function map(Model $course): array {
		/** @var SemesterCourse $course */
		return [
			"id" => $course->id,
			"semester" => $course->semester->name,
			"course" => $course->course->name,
			"index" => $course->course->form->index,
		];
	}

	/**
	 * @param Model $course
	 * @return array
	 */
	protected function mapCourses(Model $course): array {
		/** @var SemesterCourse $course */
		return [
			"id" => $course->id,
			"name" => $course->course->name . " | " . $course->course->form->name,
		];
	}

	/**
	 * @param int $id
	 * @return array
	 * @throws NotFound
	 */
	public function getCoursesBySemesterId(int $id): array {
		/** @var Semester $semester */
		$semester = Semester::findFirst($id);

		if(!$semester) {
			throw new NotFound();
		}

		$result = [];

		/** @var SemesterCourse $course */
		foreach($semester->semesterCourses as $course) {
			$result[] = $this->mapCourses($course);
		}
		
		return $result;
	}

}
