<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class NewsController extends Controller {

	public function getNewsAction(): Response {
		$news = $this->repository->get("news")->getAll();

		$this->responseArray
			->setData($news)
			->setSuccessStatus();

		return $this->renderResponse();
	}

	public function getEntryAction(int $id): Response {
		$news = $this->repository->get("news")->getById($id);

		$this->responseArray
			->setData($news)
			->setSuccessStatus();

		return $this->renderResponse();
	}

}
