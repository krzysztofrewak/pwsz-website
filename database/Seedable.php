<?php

interface Seedable {

	/**
	 * @return array
	 */
	public function getData(): array;

	/**
	 * @return string
	 */
	public function getTableName(): string;

}
