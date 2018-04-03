<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\Controller;
use PWSZ\Interfaces\CRUDControllerInterface;

abstract class CRUDController extends Controller implements CRUDControllerInterface {

	protected $model = null;
	protected $repository_name = "";

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

	public function addFormAction(): Response {
		$this->model = $this->repository->get($this->repository_name)->getRaw();

		$this->prepareFormResponse();
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	public function editFormAction(int $id): Response {
		$this->model = $this->repository->get($this->repository_name)->getRaw($id);

		$this->prepareFormResponse();
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

}
