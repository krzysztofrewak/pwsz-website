<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\ResultsetInterface;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\Semester;

class Semesters extends Repository {

	/**
	 * @return ResultsetInterface
	 */
	protected function getObjects(): ResultsetInterface {
		return $this->getModelClass()::find(["order" => "id DESC"]);
	}
	/**
	 * @return Semester
	 */
	public function getModelClass(): string {
		return Semester::class;
	}

	/**
	 * @param Model $semester
	 * @return array
	 */
	public function map(Model $semester): array {
		/** @var Semester $semester */
		return [
			"id" => $semester->id,
			"name" => $semester->name,
		];
	}

}
