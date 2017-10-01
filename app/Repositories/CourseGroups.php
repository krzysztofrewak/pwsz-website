<?php

namespace PWSZ\Repositories;

use PWSZ\Models\SemesterCourse;

class CourseGroups extends Repository {

	public function getModelClass(): string {
		return SemesterCourse::class;
	}

	public function map($model): array {
		return [
			"id" => $model->id,
			"label" => $model->name,
		];
	}

	public function getGroupsByCourseId(int $id): array {
		$semester_course = $this->getModelClass()::findFirst($id);
		$objects = $semester_course->courseGroups;
		$result = [];

		foreach($objects as $object) {
			$result[] = $this->mapSimple($object);
		}
		
		return $result;
	}

}
