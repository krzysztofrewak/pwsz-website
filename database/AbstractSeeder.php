<?php

use Phinx\Seed\AbstractSeed;

abstract class AbstractSeeder extends AbstractSeed implements Seedable {

	/**
	 * @return void
	 */
	public function run(): void {
		$this->table($this->getTableName())
			->insert($this->getData())
			->save();
	}

}
