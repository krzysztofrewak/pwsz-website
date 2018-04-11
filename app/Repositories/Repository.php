<?php

namespace PWSZ\Repositories;

use Exception;
use Phalcon\Mvc\Model\Resultset\Simple;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Interfaces\RepositoryInterface;

abstract class Repository implements RepositoryInterface {

	public function getAll(): array {
		$objects = $this->getObjects();
		$result = [];

		foreach($objects as $object) {
			$result[] = $this->mapSimple($object);
		}
		
		return $result;
	}

	public function getById(int $id): array {
		$object = $this->getObjectById($id);
		return $this->mapExtended($object);
	}

	public function create(array $request): void {
		$model = $this->getModelClass();
		(new $model)->save($request);
	}

	public function updateById(array $request, int $id): void {
		$this->getObjectById($id)->save($request);
	}

	public function deleteById(int $id): void {
		$this->getObjectById($id)->delete();
	}

	public function getRaw(int $id = null): Model {
		$model = $this->getModelClass();

		return $id ? $this->getObjectById($id) : new $model;
	}

	protected function mapSimple($object): array {
		return $this->map($object);
	}

	protected function mapExtended($object): array {
		return $this->map($object);
	}

	protected function getObjectById($id): Model {
		$model = $this->getModelClass()::findFirst($id);

		if(!$model) {
			throw new Exception();
		}

		return $model;
	}

	protected function getObjects(): Simple {
		return $this->getModelClass()::find();
	}

}
