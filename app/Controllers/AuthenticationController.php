<?php

namespace PWSZ\Controllers;

use PWSZ\Models\User;
use Phalcon\Http\Response;

class AuthenticationController extends Controller {

	/**
	 * @return Response
	 */
	public function checkAction(): Response {
		/** @var User $user */
		$user = $this->session->get("auth");

		if(!is_null($user)) {
			$this->responseArray->setSuccessStatus();
		} else {
			$this->responseArray->setStatusCode(403);
		}

		$this->logger->info("Authentication status requested and delivered.");

		return $this->renderResponse();
	}

	/**
	 * @return Response
	 */
	public function loginAction(): Response {
		$request = $this->request->getJsonRawBody();

		$login = $request->login;
		$password = $request->password;

		/** @var User $user */
		$user = User::findFirst(["login = :login:", "bind" => ["login" => $login]]);

		if($user) {
			if($this->security->checkHash($password, $user->password)) {
				$this->session->set("auth", $user);

				$this->responseArray->setMessage("Zalogowano poprawnie.");
				$this->responseArray->setSuccessStatus();

				$this->logger->info("User logged in.");

				return $this->renderResponse();
			}
		}

		$this->security->hash(rand());
		$this->responseArray->setMessage("Podano błędny login lub hasło.");

		$this->logger->warning("User not authenticated.");

		return $this->renderResponse();
	}

	/**
	 * @return Response
	 */
	public function logoutAction(): Response {
		$this->session->remove("auth");

		$this->responseArray->setMessage("Wylogowano poprawnie.");
		$this->responseArray->setSuccessStatus();

		$this->logger->info("User logged out.");

		return $this->renderResponse();
	}

}
