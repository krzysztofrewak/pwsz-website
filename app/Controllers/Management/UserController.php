<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\Controller;
use PWSZ\Models\User;

class UserController extends Controller {

	/**
	 * @return Response
	 */
	public function getAction(): Response {
		/** @var User $user */
		$user = $this->session->get("auth");

		$this->responseArray->setData($user->toArray());
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	/**
	 * @return Response
	 */
	public function updateAction(): Response {
		$request = json_decode($this->request->getRawBody());

		$user = User::findFirstById($request->user->id);

		if(is_null($user)) {
			$this->responseArray->setMessage("Nie ma takiego użytkownika.");
			return $this->renderResponse();
		}

		$user->login = $request->user->login;
		$user->email = $request->user->email;

		if(isset($request->user->new_password) && isset($request->user->new_password_repeat)) {
			if($request->user->new_password === $request->user->new_password_repeat) {
				$user->password = $this->security->hash($request->user->new_password);
			} else {
				$this->responseArray->setMessage("Podane hasła nie są tożsame.");
				return $this->renderResponse();
			}
		}

		$user->save();
		$this->session->set("auth", $user);

		$this->responseArray->setSuccessStatus();
		return $this->renderResponse();
	}
	
}
