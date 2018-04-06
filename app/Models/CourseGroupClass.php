<?php

namespace PWSZ\Models;

class CourseGroupClass extends Model {

	public $id;
	public $name;
	public $course_group_id;

	public function initialize(): void {
		$this->setSource("course_group_classes");
		
		$this->belongsTo("course_group_id", CourseGroup::class, "id", ["alias" => "Group"]);
	}
	
}
