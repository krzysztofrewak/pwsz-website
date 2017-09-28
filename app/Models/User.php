<?php

namespace PWSZ\Models;

use Phalcon\Mvc\Model;

class User extends Model {

	public $id;
	public $name;
	public $email;

	public function initialize(): void {
		$this->setSource("users");
	}
	
}
