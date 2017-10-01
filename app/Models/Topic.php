<?php

namespace PWSZ\Models;

class Topic extends Model {

	public $id;
	public $title;
	public $no;
	public $language;
	public $course_id;

	public function initialize(): void {
		$this->setSource("topics");

		$this->belongsTo("course_id", Course::class, "id", ["alias" => "Course"]);
		$this->hasMany("id", File::class, "topic_id", ["alias" => "Files"]);
	}
	
}
