<?php

namespace PWSZ\Controllers;

use Exception;
use Phalcon\Http\Response;

class NewsController extends Controller {

	public function getNewsAction(): Response {
		$this->responseArray->setData($this->repository->get("news")->getAll());
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	public function getEntryAction(int $id): Response {
		$this->responseArray->setData($this->repository->get("news")->getById($id));
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

}
