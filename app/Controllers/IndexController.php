<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class IndexController extends Controller {

	/**
	 * @return Response
	 */
	public function indexAction(): Response {
		$this->responseArray->setMessage("API is working")->setSuccessStatus();
		$this->logger->info("API status requested.");

		return $this->renderResponse();
	}

	/**
	 * @return Response
	 */
	public function notFoundAction(): Response {
		$url = $this->router->getRewriteUri();

		$this->responseArray->setMessage("URL not found")->setStatusCode(404);
		$this->logger->warning("Non-existing URL requested: [$url]");

		return $this->renderResponse();
	}

	/**
	 * @return Response
	 */
	public function noAccessAction(): Response {
		$url = $this->router->getRewriteUri();

		$this->responseArray->setMessage("URL not allowed")->setStatusCode(403);
		$this->logger->warning("Forbidden URL requested: [$url]");

		return $this->renderResponse();
	}

}
