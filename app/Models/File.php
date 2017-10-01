<?php

namespace PWSZ\Models;

class File extends Model {

	public $id;
	public $url;
	public $icon;
	public $topic_id;

	public function initialize(): void {
		$this->setSource("files");

		$this->belongsTo("topic_id", Topic::class, "id", ["alias" => "Topic"]);
	}
	
}
