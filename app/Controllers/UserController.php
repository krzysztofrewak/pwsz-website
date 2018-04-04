<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class UserController extends Controller {

	public function userAction(): Response {
		$user = $this->session->auth;

		$this->responseArray->setData($user->toArray());
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}
	
}
