<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\Controller as BaseController;

class Controller extends BaseController {

	public function prepareResponse(): void {
		$response = [
			"title" => $this->getTableTitle(),
			"columns" => $this->getTableColumnHeaders(),
			"data" => $this->getTableDataset(),
		];

		$this->responseArray->setData($response);
	}

	public function listAction(): Response {
		$this->prepareResponse();
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

}
