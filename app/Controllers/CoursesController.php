<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;
use PWSZ\Exceptions\NotFound;

class CoursesController extends Controller {

	public function getCoursesAction(): Response {
		$this->responseArray->setData($this->repository->get("courses")->getAll());
		$this->responseArray->setSuccessStatus();

		$this->logger->info("Courses list requested and delivered.");

		return $this->renderResponse();
	}

	public function getEntryAction(string $id): Response {
		$id = (int) $id;

		try {
			$course = $this->repository->get("courses")->getById($id);
		} catch(NotFound $exception) {
			$this->responseArray
				->setMessage("Course not found")
				->setStatusCode(400);

			$this->logger->warning("Non-existing course { id: ". $id ." } requested and not delivered.");

			return $this->renderResponse();
		}

		$this->responseArray->setData($course);
		$this->responseArray->setSuccessStatus();

		$this->logger->info("Course { id: ". $id ." } requested and delivered.");

		return $this->renderResponse();
	}

}
