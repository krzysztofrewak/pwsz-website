<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\Resultset\Simple;
use PWSZ\Exceptions\NotFound;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Interfaces\RepositoryInterface;

abstract class Repository implements RepositoryInterface {

	protected $actionStatus = false;
	protected $lastObjectId = "";

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

	public function create(array $request): array {
		$model = $this->getModelClass();
		$instance = (new $model);
		$this->actionStatus = $instance->save($request);

		return $this->map($instance);
	}

	public function updateById(array $request, int $id): array {
		$object = $this->getObjectById($id);
		$this->actionStatus = $object->save($request);

		return $this->map($object);
	}

	public function deleteById(int $id): void {
		$this->actionStatus = $this->getObjectById($id)->delete();
	}

	public function getRaw(int $id = null): Model {
		$model = $this->getModelClass();

		return $id ? $this->getObjectById($id) : new $model;
	}

	public function getActionStatus(): bool {
		return $this->actionStatus;
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
			throw new NotFound();
		}

		return $model;
	}

	protected function getObjects(): Simple {
		return $this->getModelClass()::find();
	}

}
