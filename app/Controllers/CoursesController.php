<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class CoursesController extends Controller {

	public function getCoursesAction(): Response {
		$this->responseArray->setData($this->repository->get("courses")->getAll());
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	public function getEntryAction(int $id): Response {
		$this->responseArray->setData($this->repository->get("courses")->getById($id));
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

}
