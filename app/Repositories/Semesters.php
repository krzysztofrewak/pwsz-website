<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\Resultset\Simple;
use PWSZ\Models\Semester;

class Semesters extends Repository {

	protected function getObjects(): Simple {
		return $this->getModelClass()::find(["order" => "id DESC"]);
	}

	public function getModelClass(): string {
		return Semester::class;
	}

	public function map($model): array {
		return [
			"id" => $model->id,
			"name" => $model->name,
		];
	}

}
