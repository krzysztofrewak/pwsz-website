<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class IndexController extends Controller {

	public function indexAction(): Response {
		$this->responseArray
			->setMessage("API is working")
			->setSuccessStatus();

		return $this->renderResponse();
	}

	public function notFoundAction(): Response {
		$this->responseArray
			->setMessage("URL not found")
			->setStatusCode(404);

		return $this->renderResponse();
	}

	public function noAccessAction(): Response {
		$this->responseArray
			->setMessage("URL not allowed")
			->setStatusCode(403);

		return $this->renderResponse();
	}

}
