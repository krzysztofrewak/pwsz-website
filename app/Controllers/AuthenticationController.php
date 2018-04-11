<?php

namespace PWSZ\Controllers;

use PWSZ\Models\User;
use Phalcon\Http\Response;

class AuthenticationController extends Controller {

	public function checkAction(): Response {
		$user = $this->session->auth;

		if(!is_null($this->session->auth)) {
			$this->responseArray->setSuccessStatus();
		} else {
			$this->responseArray->setStatusCode(403);
		}

		return $this->renderResponse();
	}

	public function loginAction(): Response {
		$request = $this->request->getJsonRawBody();

		$login = $request->login;
		$password = $request->password;

		$user = User::findFirst([
			"login = :login:",
			"bind" => [
				"login" => $login,
			]
		]);

		if($user) {
			if($this->security->checkHash($password, $user->password)) {
				$this->registerSession($user);

				$this->responseArray
					->setMessage("Zalogowano poprawnie.")
					->setSuccessStatus();

				return $this->renderResponse();
			}
		}

		$this->security->hash(rand());
		$this->responseArray->setMessage("Podano błędny login lub hasło.");

		return $this->renderResponse();
	}

	public function logoutAction(): Response {
		$this->session->remove("auth");

		$this->responseArray
			->setMessage("Wylogowano poprawnie.")
			->setSuccessStatus();

		return $this->renderResponse();
	}

	private function registerSession(User $user): void {
		$this->session->set("auth", $user);
	}
	
}
