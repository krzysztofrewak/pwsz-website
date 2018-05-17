<?php

namespace PWSZ\Controllers\Management;

use PWSZ\Controllers\GradesController as BaseGradesController;
use PWSZ\Interfaces\GradesRepositoryInterface;
use PWSZ\Repositories\ManagementGrades;

class GradesController extends BaseGradesController {

	/**
	 * @return GradesRepositoryInterface
	 */
	protected function getGradesRepository(): GradesRepositoryInterface {
		/** @var ManagementGrades $grades */
		$grades = $this->repository->get("managementGrades");

		return $grades;
	}

}
