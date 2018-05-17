<?php

namespace PWSZ\Repositories;

use Phalcon\Mvc\Model\ResultsetInterface;
use PWSZ\Exceptions\NotFound;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Interfaces\RepositoryInterface;

abstract class Repository implements RepositoryInterface {

	/** @var string $lastObjectId */
	protected $lastObjectId = "";

	/** @var bool $actionStatus */
	protected $actionStatus = false;

	/**
	 * @return array
	 */
	public function getAll(): array {
		$objects = $this->getObjects();
		$result = [];

		foreach($objects as $object) {
			$result[] = $this->mapSimple($object);
		}

		return $result;
	}

	/**
	 * @param int $id
	 * @return array
	 * @throws NotFound
	 */
	public function getById(int $id): array {
		$object = $this->getObjectById($id);
		return $this->mapExtended($object);
	}

	/**
	 * @param array $request
	 * @return array
	 */
	public function create(array $request): array {
		$model = $this->getModelClass();

		/** @var Model $instance */
		$instance = (new $model);
		$this->actionStatus = $instance->save($request);

		return $this->map($instance);
	}

	/**
	 * @param array $request
	 * @param int $id
	 * @return array
	 * @throws NotFound
	 */
	public function updateById(array $request, int $id): array {
		$object = $this->getObjectById($id);
		$this->actionStatus = $object->save($request);

		return $this->map($object);
	}

	/**
	 * @param int $id
	 * @throws NotFound
	 */
	public function deleteById(int $id): void {
		$this->actionStatus = $this->getObjectById($id)
			->delete();
	}

	/**
	 * @param int|null $id
	 * @return Model
	 * @throws NotFound
	 */
	public function getRaw(int $id = null): Model {
		$model = $this->getModelClass();

		return $id ? $this->getObjectById($id) : new $model;
	}

	/**
	 * @return bool
	 */
	public function getActionStatus(): bool {
		return $this->actionStatus;
	}

	/**
	 * @param $object
	 * @return array
	 */
	protected function mapSimple($object): array {
		return $this->map($object);
	}

	/**
	 * @param $object
	 * @return array
	 */
	protected function mapExtended($object): array {
		return $this->map($object);
	}

	/**
	 * @param $id
	 * @return Model
	 * @throws NotFound
	 */
	protected function getObjectById($id): Model {
		$model = $this->getModelClass()::findFirst($id);

		if(!$model) {
			throw new NotFound();
		}

		return $model;
	}

	/**
	 * @return ResultsetInterface
	 */
	protected function getObjects(): ResultsetInterface {
		return $this->getModelClass()::find();
	}

}
