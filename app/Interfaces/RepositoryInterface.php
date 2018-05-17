<?php

namespace PWSZ\Interfaces;

use PWSZ\Exceptions\NotFound;
use PWSZ\Interfaces\ModelInterface as Model;

interface RepositoryInterface {

	/**
	 * @param ModelInterface $model
	 * @return array
	 */
	public function map(Model $model): array;

	/**
	 * @return Model
	 */
	public function getModelClass(): string;

	/**
	 * @return array
	 */
	public function getAll(): array;

	/**
	 * @param int $id
	 * @throws NotFound
	 * @return array
	 */
	public function getById(int $id): array;

	/**
	 * @param array $request
	 * @return array
	 */
	public function create(array $request): array;

	/**
	 * @param array $request
	 * @param int $id
	 * @return array
	 */
	public function updateById(array $request, int $id): array;

	/**
	 * @param int $id
	 */
	public function deleteById(int $id): void;

	/**
	 * @param int|null $id
	 * @return ModelInterface
	 */
	public function getRaw(int $id = null): Model;
}