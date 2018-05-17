<?php

namespace PWSZ\Helpers;

use PWSZ\Interfaces\RepositoryInterface;

class RepositoryDispatcher {

	/**
	 * @param string $repository
	 * @return RepositoryInterface
	 */
	public function get(string $repository): RepositoryInterface {
		$class = "PWSZ\Repositories\\" . ucfirst($repository);
		return new $class;
	}

}
