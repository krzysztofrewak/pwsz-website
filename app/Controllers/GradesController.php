<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;

class GradesController extends Controller {

	public function getGradesAction(): Response {
		$request = json_decode($this->request->getRawBody());

		$group_id = $request->groupId;
		$student_id = $request->studentId ?: "";

		$this->responseArray->setData($this->repository->get("grades")->getGrades($group_id, $student_id));
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	public function getSemestersAction(): Response {
		$this->responseArray->setData($this->repository->get("semesters")->getAll());
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	public function getCoursesAction(): Response {
		$semester_id = json_decode($this->request->getRawBody())->semesterId;

		$this->responseArray->setData($this->repository->get("semesterCourses")->getCoursesBySemesterId($semester_id));
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	public function getGroupsAction(): Response {
		$course_id = json_decode($this->request->getRawBody())->courseId;

		$this->responseArray->setData($this->repository->get("courseGroups")->getGroupsByCourseId($course_id));
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

}
