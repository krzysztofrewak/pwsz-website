<?php

namespace PWSZ\Interfaces;

interface RepositoryInterface {

	public function map($model): array;
	public function getModelClass(): string;
	
}