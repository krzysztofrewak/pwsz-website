<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class FaqController extends Controller {

	/**
	 * @return Response
	 */
	public function getQuestionsAction(): Response {
		$faqs = $this->repository->get("faqs")->getAll();

		$this->responseArray->setData($faqs);
		$this->responseArray->setSuccessStatus();
		$this->logger->info("FAQs requested and delivered.");

		return $this->renderResponse();
	}

}
