<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;
use Phalcon\Mvc\Controller as BaseController;
use PWSZ\Helpers\ResponseArray;

abstract class Controller extends BaseController {

	protected $responseArray;

	protected function buildResponseArray(): void {
		$this->responseArray = new ResponseArray();
	}

	public function initialize(): void {
		$this->buildResponseArray();
	}

	public function beforeExecuteRoute(): void {
		$this->buildResponseArray();
	}

	public function renderResponse(): Response {
		$this->response->setStatusCode($this->responseArray->getStatusCode());
		$this->response->setJsonContent($this->responseArray);
		
		return $this->response;
	}

}
