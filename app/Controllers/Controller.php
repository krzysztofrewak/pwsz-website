<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;
use Phalcon\Logger\AdapterInterface;
use Phalcon\Mvc\Controller as BaseController;
use PWSZ\Helpers\RepositoryDispatcher;
use PWSZ\Helpers\ResponseArray;

/**
 * @property AdapterInterface logger
 * @property RepositoryDispatcher repository
 */
abstract class Controller extends BaseController {

	/** @var ResponseArray $responseArray */
	protected $responseArray;

	/**
	 * @return void
	 */
	protected function buildResponseArray(): void {
		$this->responseArray = new ResponseArray();
	}

	/**
	 * @return void
	 */
	public function initialize(): void {
		$this->buildResponseArray();
	}

	/**
	 * @return void
	 */
	public function beforeExecuteRoute(): void {
		$this->buildResponseArray();
	}

	/**
	 * @return Response
	 */
	public function renderResponse(): Response {
		$this->response->setStatusCode($this->responseArray->getStatusCode());
		$this->response->setJsonContent($this->responseArray);

		return $this->response;
	}

}
