<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\Field;

class Fields extends Repository {

	/**
	 * @return Field
	 */
	public function getModelClass(): string {
		return Field::class;
	}

	/**
	 * @param Model $field
	 * @return array
	 */
	public function map(Model $field): array {
		/** @var Field $field */
		return [
			"id" => $field->id,
			"index" => $field->index,
			"name" => $field->name,
		];
	}

}
