<?php

namespace PWSZ\Repositories;

use PWSZ\Models\Semester;

class Semesters extends Repository {

	public function getModelClass(): string {
		return Semester::class;
	}

	public function map($model): array {
		return [
			"id" => $model->id,
			"label" => $model->name,
		];
	}

}
