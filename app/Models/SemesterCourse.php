<?php

namespace PWSZ\Models;

class SemesterCourse extends Model {

	public $id;
	public $semester_id;
	public $course_id;

	public function initialize(): void {
		$this->setSource("semester_courses");
		
		$this->belongsTo("semester_id", Semester::class, "id");
		$this->belongsTo("course_id", Course::class, "id");
		$this->hasMany("id", CourseGroup::class, "semester_course_id", ["alias" => "CourseGroups"]);
		$this->hasMany("id", SemesterCourseClass::class, "semester_course_id", ["alias" => "Classes"]);
	}
	
}
