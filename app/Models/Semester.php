<?php

namespace PWSZ\Models;
use Phalcon\Mvc\Model\Resultset\Simple;

/**
 * @property Simple semesterCourses
 * @property Simple courses
 */
class Semester extends Model {

	public $id;
	public $name;

	const FIRST_SEMESTER_NO = 1;
	const LAST_SEMESTER_NO = 7;

	public function initialize(): void {
		$this->setSource("semesters");

		$this->hasMany("id", SemesterCourse::class, "semester_id", ["alias" => "SemesterCourses"]);
		$this->hasManyToMany("id", SemesterCourse::class, "semester_id", "course_id", Course::class, "id", ["alias" => "Courses"]);
	}

}
