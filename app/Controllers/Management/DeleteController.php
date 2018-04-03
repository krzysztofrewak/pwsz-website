<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\Controller as BaseController;

class DeleteController extends BaseController {

	public function deleteAction(string $repository_name, int $id): Response {
		$this->repository->get($repository_name)->deleteById($id);
		$this->responseArray->setSuccessStatus();
		
		return $this->renderResponse();
	}

}
