<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class FAQController extends Controller {

	public function getQuestionsAction(): Response {
		$this->responseArray
			->setSuccessStatus()
			->setData([
				[
					"id" => 1,
					"question" => "Przesłałem zadanie do sprawdzenia trzy minuty temu. Kiedy pojawią się oceny?",
					"answer" => "Zadania staram się sprawdzać najszybciej jak tylko mogę, ale musicie brać poprawkę na to, że mam wiele innych zajęć poza pracą na uczelni. Pozostaje Ci sprawdzać co jakiś czas stronę z wynikami lub też podpiąć się pod kanał RSS z aktualnoścami."
				],
				[
					"id" => 2,
					"question" => "Wysyłałem mejla dwa tygodnie temu i nie otrzymałem na niego odpowiedzi. Co mogło się stać?",
					"answer" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
				],
				[
					"id" => 3,
					"question" => "Nie odpisał Pan na mejla, więc napisałem na Facebooka. Kiedy mogę spodziewać się odpowiedzi?",
					"answer" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
				],
				[
					"id" => 4,
					"question" => "Nie było mnie na zajęciach. Jak mogę to odrobić?",
					"answer" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
				],
				[
					"id" => 5,
					"question" => "Kto by zwycięzył, gdyby jaskiniowcy i astronauci wdali się w walkę?",
					"answer" => "Zależy od tego czy astronauci mieliby swoje zaplecze technologiczne."
				],
			]);

		return $this->renderResponse();
	}

}
