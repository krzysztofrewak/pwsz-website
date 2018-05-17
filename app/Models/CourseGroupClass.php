<?php

namespace PWSZ\Models;

/**
 * @property CourseGroup group
 */
class CourseGroupClass extends Model {

	public $id;
	public $name;
	public $course_group_id;

	public function initialize(): void {
		$this->setSource("course_group_classes");

		$this->belongsTo("course_group_id", CourseGroup::class, "id", ["alias" => "Group"]);
	}

	public function afterCreate() {
		$students = $this->group->groupStudents;

		/** @var Student $student */
		foreach($students as $student) {
			$grade = new Grade();
			$grade->save([
				"course_group_student_id" => $student->id,
				"course_group_class_id" => $this->id,
			]);
		}
	}

}
