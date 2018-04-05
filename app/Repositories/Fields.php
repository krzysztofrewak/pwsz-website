<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\Field;

class Fields extends Repository {

	public function getModelClass(): string {
		return Field::class;
	}

	public function map(Model $model): array {
		return [
			"id" => $model->id,
			"index" => $model->index,
			"name" => $model->name,
		];
	}

}
