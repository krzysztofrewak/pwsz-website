<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\Controller as BaseController;
use PWSZ\Interfaces\ManagementControllerInterface;

class UpdateController extends BaseController {

	public function updateAction(): Response {
		$request = json_decode($this->request->getRawBody());

		$repository = $this->repository->get($request->repository)->getModelClass();
		$request = $request->request;

		$id = $request->id;

		$model = (new $repository)::findFirst($id);
		$model->save((array) $request);

		$this->responseArray
			->setData(["re" => $repository, "model" => $model])
			->setSuccessStatus();

		return $this->renderResponse();
	}

}
