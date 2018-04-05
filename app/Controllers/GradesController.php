<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;
use PWSZ\Interfaces\RepositoryInterface;

class GradesController extends Controller {

	public function getSemestersAction(): Response {
		$semesters = $this->repository->get("semesters")->getAll();

		$this->responseArray->setData($semesters);
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	public function getCoursesAction(): Response {
		$semester_id = json_decode($this->request->getRawBody())->semesterId;

		$semesterCourses = $this->repository->get("semesterCourses")->getCoursesBySemesterId($semester_id);

		$this->responseArray->setData($semesterCourses);
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	public function getGroupsAction(): Response {
		$course_id = json_decode($this->request->getRawBody())->courseId;

		$courseGroups = $this->repository->get("courseGroups")->getGroupsByCourseId($course_id);

		$this->responseArray->setData($courseGroups);
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	public function getGradesAction(): Response {
		$request = json_decode($this->request->getRawBody());

		$group_id = $request->groupId;
		$student_id = $request->studentId ?: "";

		$grades = $this->getGradesRepository()->getGrades($group_id, $student_id, !is_null($this->session->get("auth")));

		$this->responseArray->setData($grades);
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	protected function getGradesRepository(): RepositoryInterface {
		return $this->repository->get("grades");
	}

}
