<?php

namespace PWSZ\Interfaces;

use PWSZ\Models\Model;

interface RepositoryInterface {

	public function map($model): array;
	public function getModelClass(): string;

	public function getAll(): array;
	public function getById(int $id): array;
	public function deleteById(int $id): void;
	
	public function getRaw(?int $id): Model;
	
}