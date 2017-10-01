<?php

namespace Bookeshelf\Models;

class GroupStudent extends Model {

	public $id;
	public $student_id;
	public $course_group_id;

	public function initialize(): void {
		$this->setSource("group_students");
		
		$this->belongsTo("student_id", Student::class, "id");
		$this->belongsTo("course_group_id", CourseGroup::class, "id");
	}
	
}
