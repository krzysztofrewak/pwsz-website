<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\ResultsetInterface;
use PWSZ\Exceptions\NotFound;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\CourseGroup;
use PWSZ\Models\CourseGroupStudent;
use PWSZ\Models\SemesterCourse;

class CourseGroups extends Repository {

	/**
	 * @return ResultsetInterface
	 */
	protected function getObjects(): ResultsetInterface {
		return $this->getModelClass()::find(["order" => "id DESC"]);
	}

	/**
	 * @return CourseGroup
	 */
	public function getModelClass(): string {
		return CourseGroup::class;
	}

	/**
	 * @param Model $courseGroup
	 * @return array
	 */
	public function map(Model $courseGroup): array {
		/** @var CourseGroup $courseGroup */
		return [
			"id" => $courseGroup->id,
			"name" => $courseGroup->name,
			"semester" => $courseGroup->semesterCourse->semester->name,
			"course" => $courseGroup->semesterCourse->course->name,
			"form" => $courseGroup->semesterCourse->course->form->index,
			"students" => $courseGroup->students->count(),
			"is_active" => !!$courseGroup->semesterCourse->course->is_active,
		];
	}

	/**
	 * @param int $id
	 * @return array
	 * @throws NotFound
	 */
	public function getGroupsByCourseId(int $id): array {
		/** @var SemesterCourse $semester_course */
		$semester_course = SemesterCourse::findFirst($id);

		if(!$semester_course) {
			throw new NotFound();
		}

		$objects = $semester_course->groups;
		$result = [];

		foreach($objects as $object) {
			$result[] = $this->mapSimple($object);
		}

		return $result;
	}

	/**
	 * @param int $course_group_id
	 * @param int $student_id
	 */
	public function attachStudent(int $course_group_id, int $student_id): void {
		$group_student = new CourseGroupStudent();
		$group_student->save([
			"student_id" => $student_id,
			"course_group_id" => $course_group_id,
		]);
	}

	/**
	 * @param int $course_group_id
	 * @param int $student_id
	 */
	public function detachStudent(int $course_group_id, int $student_id): void {
		/** @var CourseGroupStudent $group_student */
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
