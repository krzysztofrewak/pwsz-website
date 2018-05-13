<?php

namespace PWSZ\Models;

class Grade extends Model {

	public $id;
	public $was_present;
	public $value;
	public $comment;
	public $course_group_student_id;
	public $course_group_class_id;

	public function initialize(): void {
		$this->setSource("grades");

		$this->belongsTo("course_group_student_id", CourseGroupStudent::class, "id", ["alias" => "Student"]);
		$this->belongsTo("course_group_class_id", CourseGroupClass::class, "id", ["alias" => "Class"]);
	}
	
}
