<?php

namespace PWSZ\Controllers\Management;

class FieldController extends Controller {

	public function getTableTitle(): string {
		return "Kierunki i specjalności";
	}

	public function getTableColumnHeaders(): array {
		return ["id", "skrótowiec", "nazwa"];
	}

	public function getTableDataset(): array {
		return $this->repository->get("fields")->getAll();
	}

}
