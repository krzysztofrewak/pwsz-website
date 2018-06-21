<?php

namespace PWSZ\Models;

class Mode extends Model {

	public $id;
	public $name;

	public function initialize(): void {
		$this->setSource("modes");
	}

}
