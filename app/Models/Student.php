<?php

namespace PWSZ\Models;

class Student extends Model {

	public $id;
	public $student_no;
	public $name;

	public function initialize(): void {
		$this->setSource("students");

		$this->hasMany("id", GroupStudent::class, "student_id", ["alias" => "GroupStudents"]);
		$this->hasManyToMany("id", GroupStudent::class, "student_id", "course_group_id", CourseGroup::class, "id", ["alias" => "CourseGroups"]);
	}

	public function getInitials(): string {
		return implode("", array_map(function($word) {
			return $word[0];
		}, explode(" ", $this->name)));
	}
	
}
