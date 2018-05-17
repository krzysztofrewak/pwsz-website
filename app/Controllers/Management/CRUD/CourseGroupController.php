<?php

namespace PWSZ\Controllers\Management\CRUD;

use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;
use PWSZ\Models\CourseGroup;
use PWSZ\Models\Student;

/**
 * @property CourseGroup $model
 */
class CourseGroupController extends CRUDController {

	/**
	 * @var string
	 */
	protected $repository_name = "courseGroups";

	/**
	 * @return string
	 */
	public function getTableTitle(): string {
		return "Grupy zajęciowe";
	}

	/**
	 * @return array
	 */
	public function getTableColumnHeaders(): array {
		return [
			"name" => "nazwa i termin",
			"semester" => "semestr",
			"course" => "kurs",
			"form" => "forma",
			"students" => "l. studentów",
			"is_active" => "aktywny?",
		];
	}

	/**
	 * @return string
	 */
	public function getFormTitle(): string {
		return "Edytujesz grupę: " . $this->model->name;
	}

	/**
	 * @return array
	 */
	public function getFormInputs(): array {
		$model = $this->model;
		$semester_courses = $this->buildSemesterCoursesValues($model->semester_course_id);

		$students_ids = [];
		/** @var Student $student */
		foreach($model->students as $student) {
			$students_ids[] = $student->id;
		}
		$students = $this->buildStudentsValues($students_ids);
		
		$form = [
			FormInput::setType("disabled-input")
				->setLabel("ID")
				->setName("id")
				->setValue(function() use($model) { return $model->id; })
				->get(),
			FormInput::setType("text-input")
				->setLabel("Nazwa i termin")
				->setName("name")
				->setValue(function() use($model) { return $model->name; })
				->get(),
			FormInput::setType("select-input")
				->setLabel("Kierunek")
				->setName("semester_course_id")
				->setValue(function() use($semester_courses) { return $semester_courses; })
				->get(),
		];

		if($model->id) {
			$form[] = FormInput::setType("students-input")
				->setLabel("Studenci")
				->setName("students")
				->setValue(function() use($students) { return $students; })
				->get();
		}

		return $form;
	}

	/**
	 * @param int|null $semester_course_id
	 * @return array
	 */
	protected function buildSemesterCoursesValues(?int $semester_course_id): array {
		return array_map(function($value) use($semester_course_id) {
			return [
				"label" => $value["course"] . " [" . $value["index"] . "]" . " (" . $value["semester"] . ")",
				"value" => $value["id"],
				"selected" => $value["id"] == $semester_course_id
			];
		}, $this->repository->get("semesterCourses")->getAll());
	}

	/**
	 * @param array|null $students_ids
	 * @return array
	 */
	protected function buildStudentsValues(?array $students_ids = []): array {
		return array_map(function($value) use($students_ids) {
			return [
				"label" => $value["student_no"] . " | " . $value["name"],
				"value" => $value["id"],
				"selected" => in_array($value["id"], $students_ids)
			];
		}, $this->repository->get("students")->getAll());
	}

}
