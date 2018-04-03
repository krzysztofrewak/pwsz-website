<?php

namespace PWSZ\Interfaces;

interface CRUDControllerInterface {

	public function getTableTitle(): string;
	public function getTableColumnHeaders(): array;
	public function getTableDataset(): array;
	
	public function getFormTitle(): string;
	public function getFormInputs(): array;
	
}
