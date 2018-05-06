<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\Controller;
use PWSZ\Interfaces\ManagementControllerInterface;

class UpdateController extends Controller {

	public function updateAction(): Response {
		$request = json_decode($this->request->getRawBody());
		$repositoryName = $request->repository;
		$repository = $this->repository->get($repositoryName);

		$request = $request->request;

		$id = isset($request->id) ? $request->id : null;
		$request = $this->mapValues((array) $request);
		$outcome = null;

		if($id) {
			$outcome = $repository->updateById($request, $id);
		} else {
			$outcome = $repository->create($request);
		}

		if(!$outcome) {
			$this->responseArray->setMessage("Wystąpił błąd podczas zapisywania.");
			return $this->renderResponse();
		}

		$this->responseArray->setData($outcome);
		$this->responseArray->setSuccessStatus();
		return $this->renderResponse();
	}

	protected function mapValues(array $request): array {
		$filtered = array_filter($request, function($key) {
			return $key[0] !== "_";
		}, ARRAY_FILTER_USE_KEY);

		$mapped = array_map(function($value) {
			if(is_array($value)) {
				foreach($value as $item) {
					if($item->selected) {
						return $item->value;
					}
				}
			}

			return $value;
		}, $filtered);

		return $mapped;
	}

}
