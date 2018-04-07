<?php

namespace PWSZ\Models;

class CourseTopic extends Model {

	public $id;
	public $title;
	public $no;
	public $course_id;

	public function initialize(): void {
		$this->setSource("course_topics");

		$this->belongsTo("course_id", Course::class, "id", ["alias" => "Course"]);
		$this->hasMany("id", CourseTopicFile::class, "course_topic_id", ["alias" => "Files"]);
	}
	
}
