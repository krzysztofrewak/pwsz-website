<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;
use PWSZ\Exceptions\NotFound;

class NewsController extends Controller {

	/**
	 * @return Response
	 */
	public function getNewsAction(): Response {
		$news = $this->repository->get("news")->getAll();

		$this->responseArray->setData($news)->setSuccessStatus();
		$this->logger->info("News reel requested and delivered.");

		return $this->renderResponse();
	}

	/**
	 * @param string $id
	 * @return Response
	 */
	public function getEntryAction(string $id): Response {
		$id = (int) $id;

		try {
			$news = $this->repository->get("news")->getById($id);
		} catch(NotFound $exception) {
			$this->responseArray->setMessage("News not found")->setStatusCode(400);
			$this->logger->warning("Non-existing news { id: $id } requested and not delivered.");

			return $this->renderResponse();
		}

		$this->responseArray->setData($news)->setSuccessStatus();
		$this->logger->info("News { id: $id } requested and delivered.");

		return $this->renderResponse();
	}

}
