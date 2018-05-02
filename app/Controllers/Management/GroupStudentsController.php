<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\Controller;

class GroupStudentsController extends Controller {

	public function updateStudentsInGroupAction(): Response {
		$request = json_decode($this->request->getRawBody());

		$this->manageStudentsInGroup($request->group, $request->students);

		$this->responseArray
			->setSuccessStatus();

		return $this->renderResponse();
	}

	protected function manageStudentsInGroup(int $group_id, array $request_students): void {
		$repository = $this->repository->get("courseGroups");
		$group = $repository->getRaw($group_id);

		$repository_students_ids = [];
		foreach($group->groupStudents as $student) {
			$repository_students_ids[] = $student->student_id;
		}

		foreach($request_students as $student) {
			if(in_array($student->value, $repository_students_ids)) {
				if($student->selected) {
					continue;
				} else {
					$repository->detachStudent($group_id, $student->value);
					continue;
				}
			} else {
				if($student->selected) {
					$repository->attachStudent($group_id, $student->value);
					continue;
				} else {
					continue;
				}
			}
		}
	}

}
