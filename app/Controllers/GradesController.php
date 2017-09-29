<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class GradesController extends Controller {

	public function getSemestersAction(): Response {
		$this->responseArray
			->setSuccessStatus()
			->setData([
				[
					"id" => 1,
					"label" => "zimowy 2017/18",
				],
			]);

		return $this->renderResponse();
	}

	public function getSemesterCoursesAction($semester_id): Response {
		$this->responseArray
			->setSuccessStatus()
			->setData([
				[
					"id" => 1,
					"label" => "Projekt zespołowy INF/SSK7",
				],
				[
					"id" => 2,
					"label" => "Projektowanie i programowanie obiektowe INF3",
				],
			]);

		return $this->renderResponse();
	}

	public function getGradesAction(): Response {
		$this->responseArray
			->setSuccessStatus()
			->setData([
				"grades" => [],
				"students" => []
			]);

		return $this->renderResponse();
	}

}
