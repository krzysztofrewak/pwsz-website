<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\Resultset\Simple;
use PWSZ\Interfaces\RepositoryInterface;
use PWSZ\Models\Model;

abstract class Repository implements RepositoryInterface {

	public function getById(int $id): array {
		$object = $this->getObjectById($id);
		return $this->mapExtended($object);
	}

	public function deleteById(int $id): void {
		$this->getObjectById($id)->delete();
	}

	public function updateById(int $id, array $request): void {
		$this->getObjectById($id)->save($request);
	}

	public function getAll(): array {
		$objects = $this->getObjects();
		$result = [];

		foreach($objects as $object) {
			$result[] = $this->mapSimple($object);
		}
		
		return $result;
	}

	public function getRaw(?int $id): Model {
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
		return $this->getModelClass()::findFirst($id);
	}

	protected function getObjects(): Simple {
		return $this->getModelClass()::find();
	}

}
