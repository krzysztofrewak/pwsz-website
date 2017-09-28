<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class CoursesController extends Controller {

	public function getCoursesAction(): Response {
		$this->responseArray
			->setSuccessStatus()
			->setData([
				[
					"index" => "PZ",
					"name" => "Projekt zespołowy",
					"field" => "INF/SSK",
					"semester_no" => "VII",
					"semester_name" => "zimowy",
					"form" => "projekt",
				],
				[
					"index" => "PPO",
					"name" => "Projektowanie i programowanie obiektowe",
					"field" => "INF",
					"semester_no" => "III",
					"semester_name" => "zimowy",
					"form" => "laboratorium",
				],
			]);

		return $this->renderResponse();
	}

}
