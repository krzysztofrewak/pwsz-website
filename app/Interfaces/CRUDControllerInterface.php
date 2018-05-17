<?php

namespace PWSZ\Interfaces;

interface CRUDControllerInterface {

	/**
	 * @return string
	 */
	public function getTableTitle(): string;

	/**
	 * @return array
	 */
	public function getTableColumnHeaders(): array;

	/**
	 * @return array
	 */
	public function getTableDataset(): array;

	/**
	 * @return string
	 */
	public function getFormTitle(): string;

	/**
	 * @return array
	 */
	public function getFormInputs(): array;
	
}
