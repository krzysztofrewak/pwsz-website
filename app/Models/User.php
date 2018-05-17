<?php

namespace PWSZ\Models;

/**
 * @method static User findFirstById(int $id)
 */
class User extends Model {

	public $id;
	public $login;
	public $email;
	public $password;

	public function initialize(): void {
		$this->setSource("users");
	}
	
}
