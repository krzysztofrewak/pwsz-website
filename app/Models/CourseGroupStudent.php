<?php

namespace PWSZ\Models;

class CourseGroupStudent extends Model {

	public $id;
	public $student_id;
	public $course_group_id;

	public function initialize(): void {
		$this->setSource("course_group_students");
		
		$this->belongsTo("student_id", Student::class, "id", ["alias" => "Student"]);
		$this->belongsTo("course_group_id", CourseGroup::class, "id", ["alias" => "Group"]);
		
		$this->hasMany("id", Grade::class, "course_group_student_id", ["alias" => "Grades"]);
	}

	public function afterCreate() {
		$classes = $this->group->classes;
		foreach($classes as $class) {
			$grade = new Grade();
			$grade->save([
				"course_group_class_id" => $class->id,
				"course_group_student_id" => $this->id,
			]);
		}
	}
	
}
