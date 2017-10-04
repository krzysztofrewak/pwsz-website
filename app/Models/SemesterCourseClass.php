<?php

namespace PWSZ\Models;

class SemesterCourseClass extends Model {

	public $id;
	public $name;
	public $semester_course_id;

	public function initialize(): void {
		$this->setSource("semester_course_classes");
		
		$this->belongsTo("semester_course_id", SemesterCourse::class, "id");
	}
	
}
