<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\GradesController as BaseGradesController;
use PWSZ\Interfaces\RepositoryInterface;

class GradesController extends BaseGradesController {

	protected function getGradesRepository(): RepositoryInterface {
		return $this->repository->get("managementGrades");
	}

}
