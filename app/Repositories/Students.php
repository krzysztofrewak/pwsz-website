<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\Resultset\Simple;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\Student;

class Students extends Repository {

	protected function getObjects(): Simple {
		return $this->getModelClass()::find(["order" => "student_no ASC"]);
	}

	public function getModelClass(): string {
		return Student::class;
	}

	public function map(Model $model): array {
		return [
			"id" => $model->id,
			"name" => $model->name,
			"initials" => $model->getInitials(),
			"student_no" => $model->student_no,
		];
	}

}
