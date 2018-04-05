<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\SemesterCourse;

class SemesterCourses extends Repository {

	public function getModelClass(): string {
		return SemesterCourse::class;
	}

	public function map(Model $model): array {
		return [
			"id" => $model->id,
			"semester" => $model->semester->name,
			"course" => $model->course->name,
			"index" => $model->course->form->index,
		];
	}

	protected function mapCourses(Model $model): array {
		return [
			"id" => $model->id,
			"name" => $model->index . " / " . $model->form->index,
		];
	}

	public function getCoursesBySemesterId(int $id): array {
		$repository = new Semesters();
		$semester = $repository->getModelClass()::findFirst($id);

		$result = [];

		foreach($semester->courses as $object) {
			$result[] = $this->mapCourses($object);
		}
		
		return $result;
	}

}
