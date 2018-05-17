<?php

namespace PWSZ\Interfaces;

use PWSZ\Exceptions\NotFound;

interface GradesRepositoryInterface extends RepositoryInterface {

	/**
	 * @param int $course_group_id
	 * @param string $student_no
	 * @param bool $force_result
	 * @throws NotFound
	 * @return array
	 */
	public function getGrades(int $course_group_id, string $student_no, bool $force_result = false): array;

}