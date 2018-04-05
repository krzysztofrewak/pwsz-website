<?php

namespace PWSZ\Interfaces;

use PWSZ\Interfaces\ModelInterface as Model;

interface RepositoryInterface {

	public function map(Model $model): array;
	public function getModelClass(): string;

	public function getAll(): array;
	public function getById(int $id): array;

	public function create(array $request): void;
	public function updateById(array $request, int $id): void;
	public function deleteById(int $id): void;
	
	public function getRaw(int $id = null): Model;
}