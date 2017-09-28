<?php

interface Seedable {

	public function getData(): array;
	public function getTableName(): string;

}
