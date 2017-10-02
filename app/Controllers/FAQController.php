<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class FaqController extends Controller {

	public function getQuestionsAction(): Response {
		$this->responseArray->setData($this->repository->get("faqs")->getAll());
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

}
