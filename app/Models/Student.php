<?php

namespace PWSZ\Models;

use Phalcon\Mvc\Model\Resultset\Simple;

/**
 * @property Simple groupStudents
 * @property Simple group
 */
class Student extends Model {

	public $id;
	public $student_no;
	public $name;

	public function initialize(): void {
		$this->setSource("students");

		$this->hasMany("id", CourseGroupStudent::class, "student_id", ["alias" => "GroupStudents"]);
		$this->hasManyToMany("id", CourseGroupStudent::class, "student_id", "course_group_id", CourseGroup::class, "id", ["alias" => "Group"]);
	}

	public function getInitials(): string {
		return implode("", array_map(function($word) {
			return mb_substr($word, 0, 1);
		}, explode(" ", $this->name)));
	}

}
