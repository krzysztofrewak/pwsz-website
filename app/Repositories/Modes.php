<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\Mode;

class Modes extends Repository {

	/**
	 * @return Mode
	 */
	public function getModelClass(): string {
		return Mode::class;
	}

	/**
	 * @param Model $mode
	 * @return array
	 */
	public function map(Model $mode): array {
		/** @var Mode $mode */
		return [
			"id" => $mode->id,
			"name" => $mode->name,
		];
	}

}
