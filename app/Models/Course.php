<?php

namespace PWSZ\Models;

class Course extends Model {

	public $id;
	public $index;
	public $name;
	public $field_id;
	public $semester_no;
	public $form_id;
	public $rules;
	public $is_active;

	public function initialize(): void {
		$this->setSource("courses");

		$this->belongsTo("field_id", Field::class, "id", ["alias" => "Field"]);
		$this->belongsTo("form_id", Form::class, "id", ["alias" => "Form"]);
		$this->hasMany("id", Topic::class, "course_id", ["alias" => "Topics"]);

		$this->hasMany("id", SemesterCourse::class, "course_id", ["alias" => "SemesterCourses"]);
		$this->hasManyToMany("id", SemesterCourse::class, "course_id", "semester_id", Semester::class, "id", ["alias" => "Semesters"]);
	}
	
}
