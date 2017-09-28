<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class NewsController extends Controller {

	public function getNewsAction(): Response {
		$this->responseArray
			->setSuccessStatus()
			->setData([
				[
					"title" => "Testowy wpis",
					"timestamp" => "1 października 2017 o 15:01",
				],
				[
					"title" => "Początek nowego semestru",
					"timestamp" => "1 października 2017 o 14:23",
				],
			]);

		return $this->renderResponse();
	}

}
