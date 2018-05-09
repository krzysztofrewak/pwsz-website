<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class IndexController extends Controller {

	public function indexAction(): Response {
		$this->responseArray
			->setMessage("API is working")
			->setSuccessStatus();

		$this->logger->info("API status requested.");

		return $this->renderResponse();
	}

	public function notFoundAction(): Response {
		$this->responseArray
			->setMessage("URL not found")
			->setStatusCode(404);

		$this->logger->warning("Non-existing URL requested: [". $this->router->getRewriteUri() ."]");

		return $this->renderResponse();
	}

	public function noAccessAction(): Response {
		$this->responseArray
			->setMessage("URL not allowed")
			->setStatusCode(403);

		$this->logger->warning("Forbidden URL requested: [". $this->router->getRewriteUri() ."]");

		return $this->renderResponse();
	}

}
