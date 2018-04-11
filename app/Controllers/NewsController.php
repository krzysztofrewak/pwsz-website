<?php

namespace PWSZ\Controllers;

use Exception;
use Phalcon\Http\Response;

class NewsController extends Controller {

	public function getNewsAction(): Response {
		$news = $this->repository->get("news")->getAll();

		$this->responseArray
			->setData($news)
			->setSuccessStatus();

		return $this->renderResponse();
	}

	public function getEntryAction(string $id): Response {
		try {
			$news = $this->repository->get("news")->getById((int) $id);
		} catch(Exception $exception) {
			$this->responseArray
				->setMessage("News not found")
				->setStatusCode(400);

			return $this->renderResponse();
		}

		$this->responseArray
			->setData($news)
			->setSuccessStatus();

		return $this->renderResponse();
	}

}
