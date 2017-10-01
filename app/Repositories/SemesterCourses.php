<?php

namespace PWSZ\Repositories;

use PWSZ\Models\Semester;

class SemesterCourses extends Repository {

	public function getModelClass(): string {
		return Semester::class;
	}

	public function map($model): array {
		return [
			"id" => $model->id,
			"label" => $model->name,
		];
	}

	public function getCoursesBySemesterId(int $id): array {
		$semester = $this->getModelClass()::findFirst($id);
		$objects = $semester->courses;
		$result = [];

		foreach($objects as $object) {
			$result[] = $this->mapSimple($object);
		}
		
		return $result;
	}

}
