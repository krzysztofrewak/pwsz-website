<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\Resultset\Simple;
use PWSZ\Interfaces\RepositoryInterface;
use PWSZ\Models\Model;

abstract class Repository implements RepositoryInterface {

	protected function mapSimple($object): array {
		return $this->map($object);
	}

	protected function mapExtended($object): array {
		return $this->map($object);
	}

	protected function getObjectById($id): Model {
		return $this->getModelClass()::findFirst($id);
	}

	public function getById(int $id): array {
		$object = $this->getObjectById($id);
		return $this->mapExtended($object);
	}

	protected function getObjects(): Simple {
		return $this->getModelClass()::find();
	}

	public function getAll(): array {
		$objects = $this->getObjects();
		$result = [];

		foreach($objects as $object) {
			$result[] = $this->mapSimple($object);
		}
		
		return $result;
	}

}
