<?php

namespace PWSZ\Models;

class CourseGroup extends Model {

	public $id;
	public $name;
	public $semester_course_id;

	public function initialize(): void {
		$this->setSource("course_groups");

		$this->belongsTo("semester_course_id", SemesterCourse::class, "id", ["alias" => "SemesterCourse"]);
		$this->hasMany("id", GroupStudent::class, "course_group_id", ["alias" => "GroupStudents"]);
		$this->hasManyToMany("id", GroupStudent::class, "course_group_id", "student_id", Student::class, "id", ["alias" => "Students"]);
		$this->hasMany("id", SemesterCourseClass::class, "semester_course_id", ["alias" => "Classes"]);
	}
	
}
