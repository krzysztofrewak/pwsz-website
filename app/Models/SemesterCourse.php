<?php

namespace PWSZ\Models;

use Phalcon\Mvc\Model\Resultset\Simple;

/**
 * @property Semester semester
 * @property Course course
 * @property Simple groups
 */
class SemesterCourse extends Model {

	public $id;
	public $semester_id;
	public $course_id;

	public function initialize(): void {
		$this->setSource("semester_courses");

		$this->belongsTo("semester_id", Semester::class, "id", ["alias" => "Semester"]);
		$this->belongsTo("course_id", Course::class, "id", ["alias" => "Course"]);
		$this->hasMany("id", CourseGroup::class, "semester_course_id", ["alias" => "Groups"]);
	}

}
