<?php

namespace PWSZ\Models;

class GroupStudent extends Model {

	public $id;
	public $student_id;
	public $course_group_id;

	public function initialize(): void {
		$this->setSource("group_students");
		
		$this->belongsTo("student_id", Student::class, "id", ["alias" => "Student"]);
		$this->belongsTo("course_group_id", CourseGroup::class, "id", ["alias" => "Group"]);
		$this->hasMany("id", StudentClass::class, "group_student_id", ["alias" => "Classes"]);
	}
	
}
