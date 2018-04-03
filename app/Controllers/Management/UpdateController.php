<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\Controller;
use PWSZ\Interfaces\ManagementControllerInterface;

class UpdateController extends Controller {

	public function updateAction(): Response {
		$request = json_decode($this->request->getRawBody());
		$repositoryName = $request->repository;

		$request = $request->request;

		$id = $request->id;
		$request = $this->mapValues((array) $request);

		$this->repository->get($repositoryName)->updateById($id, $request);
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	protected function mapValues(array $request): array {
		return array_map(function($value) {
			if(is_array($value)) {
				foreach($value as $item) {
					if($item->selected) {
						return $item->value;
					}
				}
			}

			return $value;
		}, $request);
	}

}
