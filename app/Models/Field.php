<?php

namespace PWSZ\Models;

class Field extends Model {

	public $id;
	public $index;
	public $name;

	public function initialize(): void {
		$this->setSource("fields");
	}

}
