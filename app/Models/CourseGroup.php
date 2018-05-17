<?php

namespace PWSZ\Models;

use Phalcon\Mvc\Model\Resultset\Simple;

/**
 * @property SemesterCourse semesterCourse
 * @property Simple groupStudents
 * @property Simple classes
 * @property Simple students
 * @method Simple getStudents(array $parameters)
 */
class CourseGroup extends Model {

	public $id;
	public $name;
	public $semester_course_id;

	public function initialize(): void {
		$this->setSource("course_groups");

		$this->belongsTo("semester_course_id", SemesterCourse::class, "id", ["alias" => "SemesterCourse"]);
		$this->hasMany("id", CourseGroupStudent::class, "course_group_id", ["alias" => "GroupStudents"]);
		$this->hasMany("id", CourseGroupClass::class, "course_group_id", ["alias" => "Classes"]);
		$this->hasManyToMany("id", CourseGroupStudent::class, "course_group_id", "student_id", Student::class, "id", ["alias" => "Students"]);
	}

}
