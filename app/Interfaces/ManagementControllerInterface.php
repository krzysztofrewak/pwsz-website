<?php

namespace PWSZ\Interfaces;

interface ManagementControllerInterface {

	public function getTableTitle(): string;
	public function getTableColumnHeaders(): array;
	public function getTableDataset(): array;
	
}
