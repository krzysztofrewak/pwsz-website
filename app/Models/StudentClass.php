<?php

namespace PWSZ\Models;

class StudentClass extends Model {

	public $id;
	public $student_no;
	public $initials;

	public function initialize(): void {
		$this->setSource("student_classes");

		$this->belongsTo("group_student_id", GroupStudent::class, "id");
		$this->belongsTo("class_id", SemesterCourseClass::class, "id");
	}
	
}
