<?php

namespace PWSZ\Controllers\Management\CRUD;

use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;
use PWSZ\Models\SemesterCourse;

/**
 * @property SemesterCourse $model
 */
class SemesterCourseController extends CRUDController {

	/**
	 * @var string
	 */
	protected $repository_name = "semesterCourses";

	/**
	 * @return string
	 */
	public function getTableTitle(): string {
		return "Kursy w semestrze";
	}

	/**
	 * @return array
	 */
	public function getTableColumnHeaders(): array {
		return [
			"semester" => "semestr",
			"course" => "kurs",
		];
	}

	/**
	 * @return string
	 */
	public function getFormTitle(): string {
		return "Edytujesz";
	}

	/**
	 * @param int|null $form_id
	 * @return array
	 */
	protected function buildSemestersValues(?int $form_id): array {
		return array_map(function($value) use($form_id) {
			return [
				"label" => $value["name"],
				"value" => $value["id"],
				"selected" => $value["id"] == $form_id
			];
		}, $this->repository->get("semesters")->getAll());
	}

	/**
	 * @param int|null $form_id
	 * @return array
	 */
	protected function buildCoursesValues(?int $form_id): array {
		return array_map(function($value) use($form_id) {
			return [
				"label" => $value["index"] . " / " . $value["form"],
				"value" => $value["id"],
				"selected" => $value["id"] == $form_id
			];
		}, $this->repository->get("courses")->getAll());
	}

	/**
	 * @return array
	 */
	public function getFormInputs(): array {
		$model = $this->model;
		$semesters = $this->buildSemestersValues($model->semester_id);
		$courses = $this->buildCoursesValues($model->course_id);
		
		return [
			FormInput::setType("disabled-input")
				->setLabel("ID")
				->setName("id")
				->setValue(function() use($model) { return $model->id; })
				->get(),
			FormInput::setType("select-input")
				->setLabel("Semestr")
				->setName("semester_id")
				->setValue(function() use($semesters) { return $semesters; })
				->get(),
			FormInput::setType("select-input")
				->setLabel("Kurs")
				->setName("course_id")
				->setValue(function() use($courses) { return $courses; })
				->get(),
		];
	}

}
