<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class ConsultationsController extends Controller {

	/**
	 * @return Response
	 */
	public function getConsultationsAction(): Response {
		$consultations = $this->repository->get("consultations")->getAll();

		$this->responseArray->setData($consultations);
		$this->responseArray->setSuccessStatus();
		$this->logger->info("Consultations requested and delivered.");

		return $this->renderResponse();
	}

}
