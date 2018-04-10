<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\Controller;

class UserController extends Controller {

	public function userAction(): Response {
		$user = $this->session->auth;

		$this->responseArray->setData($user->toArray());
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}
	
}
