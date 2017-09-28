<?php

use Phalcon\Di;
use Phinx\Seed\AbstractSeed;

abstract class AbstractSeeder extends AbstractSeed implements Seedable {

	public function run() {
		$this->table($this->getTableName())
			->insert($this->getData())
			->save();
	}

}
