<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\Form;

class Forms extends Repository {

	/**
	 * @return Form
	 */
	public function getModelClass(): string {
		return Form::class;
	}

	/**
	 * @param Model $form
	 * @return array
	 */
	public function map(Model $form): array {
		/** @var Form $form */
		return [
			"id" => $form->id,
			"index" => $form->index,
			"name" => $form->name,
		];
	}

}
