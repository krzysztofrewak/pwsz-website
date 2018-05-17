<?php

namespace PWSZ\Models;

class User extends Model {

	public $id;
	public $login;
	public $email;
	public $password;

	public function initialize(): void {
		$this->setSource("users");
	}
	
}
