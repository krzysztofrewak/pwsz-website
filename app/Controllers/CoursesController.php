<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;
use PWSZ\Exceptions\NotFound;

class CoursesController extends Controller {

	/**
	 * @return Response
	 */
	public function getCoursesAction(): Response {
		$courses = $this->repository->get("courses")
			->getAll();

		$this->responseArray->setData($courses);
		$this->responseArray->setSuccessStatus();
		$this->logger->info("Courses list requested and delivered.");

		return $this->renderResponse();
	}

	/**
	 * @param string $id
	 * @return Response
	 */
	public function getEntryAction(string $id): Response {
		$id = (int) $id;

		try {
			$repository = $this->repository->get("courses");
			$course = $repository->getById($id);
		} catch(NotFound $exception) {
			$this->responseArray->setMessage("Course not found");
			$this->responseArray->setStatusCode(400);
			$this->logger->warning("Non-existing course { id: " . $id . " } requested and not delivered.");

			return $this->renderResponse();
		}

		$this->responseArray->setData($course);
		$this->responseArray->setSuccessStatus();
		$this->logger->info("Course { id: " . $id . " } requested and delivered.");

		return $this->renderResponse();
	}

}
