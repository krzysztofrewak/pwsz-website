<?php

namespace PWSZ\Controllers;

use PWSZ\Models\User;
use Phalcon\Http\Response;

class AuthenticationController extends Controller {

	public function checkAction(): Response {
		$this->response->setJsonContent(["auth_status" => !is_null($this->session->auth)]);
		return $this->response;
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
				$this->response->setJsonContent(["success" => "Zalogowano poprawnie."]);
				
				return $this->response;
			}
		}

		$this->security->hash(rand());
		$this->response->setJsonContent(["error" => "Podano błędny login lub hasło."]);

		return $this->response;
	}

	public function logoutAction(): Response {
		$this->session->remove("auth");
		$this->response->setJsonContent(["success" => "Wylogowano poprawnie."]);

		return $this->response;
	}

	private function registerSession(User $user): void {
		$this->session->set("auth", $user);
	}
	
}
