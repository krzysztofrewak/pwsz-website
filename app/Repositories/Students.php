<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\ResultsetInterface;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\Student;

class Students extends Repository {

	/**
	 * @return ResultsetInterface
	 */
	protected function getObjects(): ResultsetInterface {
		return $this->getModelClass()::find(["order" => "student_no ASC"]);
	}

	/**
	 * @return Student
	 */
	public function getModelClass(): string {
		return Student::class;
	}

	/**
	 * @param Model $student
	 * @return array
	 */
	public function map(Model $student): array {
		/** @var Student $student */
		return [
			"id" => $student->id,
			"name" => $student->name,
			"initials" => $student->getInitials(),
			"student_no" => $student->student_no,
		];
	}

}
