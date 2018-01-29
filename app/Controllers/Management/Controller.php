<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\Controller as BaseController;
use PWSZ\Interfaces\ManagementControllerInterface;

abstract class Controller extends BaseController implements ManagementControllerInterface {

	protected $model = null;

	protected function prepareListResponse(): void {
		$response = [
			"title" => $this->getTableTitle(),
			"columns" => $this->getTableColumnHeaders(),
			"data" => $this->getTableDataset(),
		];

		$this->responseArray->setData($response);
	}

	protected function prepareFormResponse(): void {
		$response = [
			"title" => $this->getFormTitle(),
			"inputs" => $this->getFormInputs()
		];

		$this->responseArray->setData($response);
	}

	public function getTableDataset(): array {
		return $this->repository->get($this->repository_name)->getAll();
	}

	public function listAction(): Response {
		$this->prepareListResponse();
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	public function formAction(int $id): Response {
		$this->model = $this->repository->get($this->repository_name)->getModelClass()::findFirst($id);

		$this->prepareFormResponse();
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

}
