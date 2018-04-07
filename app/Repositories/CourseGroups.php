<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\Resultset\Simple;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\CourseGroup;
use PWSZ\Models\CourseGroupStudent;
use PWSZ\Models\SemesterCourse;

class CourseGroups extends Repository {

	protected function getObjects(): Simple {
		return $this->getModelClass()::find(["order" => "id DESC"]);
	}

	public function getModelClass(): string {
		return CourseGroup::class;
	}

	public function map(Model $model): array {
		return [
			"id" => $model->id,
			"name" => $model->name,
			"semester" => $model->semesterCourse->semester->name,
			"course" => $model->semesterCourse->course->name,
			"form" => $model->semesterCourse->course->form->index,
			"students" => $model->students->count(),
			"is_active" => !!$model->semesterCourse->course->is_active,
		];
	}

	public function getGroupsByCourseId(int $id): array {
		$semester_course = SemesterCourse::findFirst($id);
		$objects = $semester_course->groups;
		$result = [];

		foreach($objects as $object) {
			$result[] = $this->mapSimple($object);
		}
		
		return $result;
	}

	public function attachStudent(int $course_group_id, int $student_id): void {
		$group_student = new CourseGroupStudent();
		$group_student->save([
			"student_id" => $student_id,
			"course_group_id" => $course_group_id,
		]);
	}

	public function detachStudent(int $course_group_id, int $student_id): void {
		$group_student = CourseGroupStudent::query()
			->where("course_group_id = :group:")
			->andWhere("student_id = :student:")
			->bind([
				"group" => $course_group_id,
				"student" => $student_id,
			])
			->execute();

		$group_student->delete();
	}

}
