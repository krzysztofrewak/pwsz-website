<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\Controller;

class GroupStudentsController extends Controller {

	public function updateStudentsInGroupAction(): Response {
		$request = json_decode($this->request->getRawBody());

		$x = $this->get($request->group, $request->students);

		$this->responseArray
			->setData([$x])
			->setSuccessStatus();

		return $this->renderResponse();
	}

	protected function get(int $group_id, array $request_students): array {
		$repository = $this->repository->get("courseGroups");
		$group = $repository->getRaw($group_id);

		$repository_students_ids = [];
		foreach($group->groupStudents as $student) {
			$repository_students_ids[] = $student->student_id;
		}

		$queue = [];

		foreach($request_students as $student) {
			if(in_array($student->value, $repository_students_ids)) {
				if($student->selected) {
					$queue[] = $student->label . " unaffected";
					continue;
				} else {
					$queue[] = $student->label . " detached";
					$repository->detachStudent($group_id, $student->value);
					continue;
				}
			} else {
				if($student->selected) {
					$queue[] = $student->label . " attached";
					$repository->attachStudent($group_id, $student->value);
					continue;
				} else {
					$queue[] = $student->label . " unaffected";
					continue;
				}
			}
		}

		return $queue;
	}

}
