<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class CoursesController extends Controller {

	public function getCoursesAction(): Response {
		$this->responseArray
			->setSuccessStatus()
			->setData([
				[
					"id" => 1,
					"active" => true,
					"index" => "PZ",
					"name" => "Projekt zespołowy",
					"field" => "INF/SSK",
					"semester_no" => "VII",
					"semester_name" => "zimowy",
					"form" => "projekt",
				],
				[
					"id" => 2,
					"active" => true,
					"index" => "PPO",
					"name" => "Projektowanie i programowanie obiektowe",
					"field" => "INF",
					"semester_no" => "III",
					"semester_name" => "zimowy",
					"form" => "laboratorium",
				],
				[
					"id" => 3,
					"active" => false,
					"index" => "PPSI",
					"name" => "Projektowanie i programowanie systemów internetowych I",
					"field" => "INF/PAM",
					"semester_no" => "IV",
					"semester_name" => "letni",
					"form" => "projekt",
				],
			]);

		return $this->renderResponse();
	}

	public function getEntryAction(): Response {
		$this->responseArray
			->setSuccessStatus()
			->setData([
				"id" => 1,
				"name" => "Projekt zespołowy",
				"field" => "INF/SSK",
				"semester_no" => "VII",
				"form" => "projekt",
			]);

		return $this->renderResponse();
	}

}
