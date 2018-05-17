<?php

namespace PWSZ\Models;

class Form extends Model {

	public $id;
	public $index;
	public $name;

	public function initialize(): void {
		$this->setSource("forms");
	}

}
