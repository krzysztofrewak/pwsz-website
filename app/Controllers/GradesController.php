<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;
use PWSZ\Exceptions\NotFound;
use PWSZ\Interfaces\GradesRepositoryInterface;
use PWSZ\Repositories\CourseGroups;
use PWSZ\Repositories\Grades;
use PWSZ\Repositories\SemesterCourses;

class GradesController extends Controller {

	/**
	 * @return Response
	 */
	public function getSemestersAction(): Response {
		$semesters = $this->repository->get("semesters")->getAll();

		$this->responseArray->setData($semesters);
		$this->responseArray->setSuccessStatus();
		$this->logger->info("Semesters requested and delivered.");

		return $this->renderResponse();
	}

	/**
	 * @return Response
	 */
	public function getCoursesAction(): Response {
		$semester_id = (int) $this->request->get("semesterId");

		try {
			/** @var SemesterCourses $repository */
			$repository = $this->repository->get("semesterCourses");
			$semesterCourses = $repository->getCoursesBySemesterId($semester_id);
		} catch(NotFound $exception) {
			$this->responseArray->setMessage("Semester not found")->setStatusCode(400);
			$this->logger->warning("Courses requested for non-existing semester { id: $semester_id } and not delivered.");

			return $this->renderResponse();
		}

		$this->responseArray->setData($semesterCourses);
		$this->responseArray->setSuccessStatus();
		$this->logger->info("Courses requested for semester { id: $semester_id } and delivered.");

		return $this->renderResponse();
	}

	/**
	 * @return Response
	 */
	public function getGroupsAction(): Response {
		$course_id = (int) $this->request->get("courseId");

		try {
			/** @var CourseGroups $repository */
			$repository = $this->repository->get("courseGroups");
			$courseGroups = $repository->getGroupsByCourseId($course_id);
		} catch(NotFound $exception) {
			$this->responseArray->setMessage("Course not found")->setStatusCode(400);
			$this->logger->warning("Groups requested for non-existing course { id: $course_id } and not delivered.");

			return $this->renderResponse();
		}

		$this->responseArray->setData($courseGroups);
		$this->responseArray->setSuccessStatus();
		$this->logger->info("Groups requested for course { id: $course_id } and delivered.");

		return $this->renderResponse();
	}

	/**
	 * @return Response
	 */
	public function getGradesAction(): Response {
		$group_id = (int) $this->request->get("groupId");
		$student_id = (int) ($this->request->get("studentId") ?: "");

		$authenticated = !is_null($this->session->get("auth"));

		try {
			$grades = $this->getGradesRepository()->getGrades($group_id, $student_id, $authenticated);
		} catch(NotFound $exception) {
			$this->responseArray->setMessage("Group not found")->setStatusCode(400);
			$this->logger->warning("Grades requested for non-existing group { id: $group_id } and not delivered.");

			return $this->renderResponse();
		}

		$this->responseArray->setData($grades);
		$this->responseArray->setSuccessStatus();

		if($authenticated) {
			$this->logger->info("Grades requested for group { id: $group_id } by administrator and delivered.");
		} else {
			if(empty($grades)) {
				$no = $student_id ?: "[?]";
				$this->logger->warning("Grades requested for group { id: $group_id } by non-existing student { no: ($no) } and not delivered.");
			} else {
				$this->logger->info("Grades requested for group { id: $group_id } by student { no: $student_id } and delivered.");
			}
		}

		return $this->renderResponse();
	}

	/**
	 * @return GradesRepositoryInterface
	 */
	protected function getGradesRepository(): GradesRepositoryInterface {
		/** @var Grades $grades */
		$grades = $this->repository->get("grades");

		return $grades;
	}

}
