<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;
use Phalcon\Mvc\Controller as BaseController;

class Controller extends BaseController {

	public function renderResponse(): Response {
		$this->response->setJsonContent($this->responseArray);
		return $this->response;
	}

}
