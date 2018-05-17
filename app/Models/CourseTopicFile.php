<?php

namespace PWSZ\Models;

/**
 * @property CourseTopic topic
 */
class CourseTopicFile extends Model {

	public $id;
	public $url;
	public $icon;
	public $course_topic_id;

	public function initialize(): void {
		$this->setSource("course_topic_files");

		$this->belongsTo("course_topic_id", CourseTopic::class, "id", ["alias" => "Topic"]);
	}

}
