<?php

namespace PWSZ\Models;

class Semester extends Model {

	public $id;
	public $name;

	public function initialize(): void {
		$this->setSource("semesters");

		$this->hasMany("id", SemesterCourse::class, "semester_id", ["alias" => "SemesterCourses"]);
		$this->hasManyToMany("id", SemesterCourse::class, "semester_id", "course_id", Course::class, "id", ["alias" => "Courses"]);
	}
	
}
