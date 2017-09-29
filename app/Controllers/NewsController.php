<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class NewsController extends Controller {

	protected $news_content = "<p>Witam wszystkich w nowym semestrze. Dla Was najpewniej którymś już z kolei, a dla mnie pierwszym.</p>";

	public function getNewsAction(): Response {
		$this->responseArray
			->setSuccessStatus()
			->setData([
				[
					"id" => 1,
					"title" => "Początek nowego semestru",
					"timestamp" => "1 października 2017 o 00:01",
					"content" => $this->news_content
				],
			]);

		return $this->renderResponse();
	}

	public function getEntryAction(int $id): Response {
		$this->responseArray
			->setSuccessStatus()
			->setData([
				"id" => 1,
				"title" => "Początek nowego semestru",
				"timestamp" => "1 października 2017 o 00:01",
				"content" => $this->news_content
			]);

		return $this->renderResponse();
	}

}
