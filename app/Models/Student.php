<?php

namespace PWSZ\Models;

class Student extends Model {

	public $id;
	public $student_no;
	public $initials;

	public function initialize(): void {
		$this->setSource("students");

		$this->hasMany("id", GroupStudent::class, "student_id", ["alias" => "GroupStudents"]);
		$this->hasManyToMany("id", GroupStudent::class, "student_id", "course_group_id", CourseGroup::class, "id", ["alias" => "CourseGroups"]);
	}
	
}
