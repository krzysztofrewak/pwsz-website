<?php

namespace PWSZ\Models;

class News extends Model {

	public $id;
	public $title;
	public $content;
	public $created_at;

	public function initialize(): void {
		$this->setSource("news");
	}
	
}
