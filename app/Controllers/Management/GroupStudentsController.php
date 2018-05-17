<?php

namespace PWSZ\Controllers\Management;

use Phalcon\Http\Response;
use PWSZ\Controllers\Controller;
use PWSZ\Exceptions\NotFound;
use PWSZ\Helpers\SelectItem;
use PWSZ\Models\CourseGroup;
use PWSZ\Models\CourseGroupStudent;
use PWSZ\Repositories\CourseGroups;

class GroupStudentsController extends Controller {

	/**
	 * @return Response
	 * @throws NotFound
	 */
	public function updateStudentsInGroupAction(): Response {
		$request = json_decode($this->request->getRawBody());

		$this->manageStudentsInGroup($request->group, $request->students);

		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	/**
	 * @param int $group_id
	 * @param array $request_students
	 * @throws NotFound
	 */
	protected function manageStudentsInGroup(int $group_id, array $request_students): void {
		$repository_students_ids = [];

		/** @var CourseGroups $repository */
		$repository = $this->repository->get("courseGroups");
		/** @var CourseGroup $group */
		$group = $repository->getRaw($group_id);

		/** @var CourseGroupStudent $student */
		foreach($group->groupStudents as $student) {
			$repository_students_ids[] = $student->student_id;
		}

		/** @var SelectItem $student */
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
