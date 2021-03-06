<?php

namespace PWSZ\Models;

use Phalcon\Mvc\Model\Resultset\Simple;

/**
 * @property Field field
 * @property Form form
 * @property Simple topics
 * @property Simple semesterCourses
 * @property Simple semesters
 */
class Course extends Model {

	public $id;
	public $index;
	public $name;
	public $field_id;
	public $semester_no;
	public $form_id;
	public $description;
	public $is_active;

	public function initialize(): void {
		$this->setSource("courses");

		$this->belongsTo("field_id", Field::class, "id", ["alias" => "Field"]);
		$this->belongsTo("form_id", Form::class, "id", ["alias" => "Form"]);
		$this->hasMany("id", CourseTopic::class, "course_id", ["alias" => "Topics"]);
		$this->hasMany("id", SemesterCourse::class, "course_id", ["alias" => "SemesterCourses"]);
		$this->hasManyToMany("id", SemesterCourse::class, "course_id", "semester_id", Semester::class, "id", ["alias" => "Semesters"]);
	}

}
