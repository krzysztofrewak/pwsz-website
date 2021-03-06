<?php

namespace PWSZ\Controllers\Management\CRUD;

use Phalcon\Mvc\Model\Resultset\Simple;
use PWSZ\Controllers\Management\CRUDController;
use PWSZ\Helpers\FormInput;
use PWSZ\Helpers\NumberToRoman;
use PWSZ\Models\Course;
use PWSZ\Models\CourseTopic;
use PWSZ\Models\CourseTopicFile;
use PWSZ\Models\Semester;

/**
 * @property Course $model
 */
class CourseController extends CRUDController {

	/**
	 * @var string
	 */
	protected $repository_name = "courses";

	/**
	 * @return string
	 */
	public function getTableTitle(): string {
		return "Kursy";
	}

	/**
	 * @return array
	 */
	public function getTableColumnHeaders(): array {
		return [
			"index" => "#",
			"name" => "nazwa",
			"field" => "kier./spec.",
			"semester_no" => "semestr",
			"form" => "forma",
			"active" => "aktywny?",
		];
	}

	/**
	 * @return string
	 */
	public function getFormTitle(): string {
		return "Edytujesz kurs: " . $this->model->name;
	}

	/**
	 * @return array
	 */
	public function getFormInputs(): array {
		$model = $this->model;

		$fields = $this->buildFieldsValues($model->field_id);
		$forms = $this->buildFormsValues($model->form_id);
		$semesters = $this->buildSemestersValues($model->semester_no);
		$topics = $this->buildTopicsTable($model->topics);

		$form = [
			FormInput::setType("disabled-input")
				->setLabel("ID")
				->setName("id")
				->setValue(function() use($model) { return $model->id; })
				->get(),
			FormInput::setType("text-input")
				->setLabel("Skrótowiec")
				->setName("index")
				->setValue(function() use($model) { return $model->index; })
				->get(),
			FormInput::setType("text-input")
				->setLabel("Nazwa")
				->setName("name")
				->setValue(function() use($model) { return $model->name; })
				->get(),
			FormInput::setType("boolean-input")
				->setLabel("Aktywny?")
				->setName("is_active")
				->setValue(function() use($model) { return $model->is_active; })
				->get(),
			FormInput::setType("select-input")
				->setLabel("Kierunek")
				->setName("field_id")
				->setValue(function() use($fields) { return $fields; })
				->get(),
			FormInput::setType("select-input")
				->setLabel("Semestr")
				->setName("semester_no")
				->setValue(function() use($semesters) { return $semesters; })
				->get(),
			FormInput::setType("select-input")
				->setLabel("Forma")
				->setName("form_id")
				->setValue(function() use($forms) { return $forms; })
				->get(),
			FormInput::setType("description-input")
				->setLabel("Opis")
				->setName("description")
				->setValue(function() use($model) { return $model->description; })
				->get(),
		];

		if($model->id) {
			$form[] = FormInput::setType("course-topics-input")
				->setLabel("Tematy")
				->setName("_topics")
				->setValue(function() use($topics) { return $topics; })
				->get();
		}

		return $form;
	}

	/**
	 * @param int|null $semester_no
	 * @return array
	 */
	protected function buildSemestersValues(?int $semester_no): array {
		return array_map(function($value) use($semester_no) {
			return [
				"label" => NumberToRoman::transform($value),
				"value" => $value,
				"selected" => $value == $semester_no
			];
		}, range(Semester::FIRST_SEMESTER_NO, Semester::LAST_SEMESTER_NO));
	}

	/**
	 * @param int|null $form_id
	 * @return array
	 */
	protected function buildFormsValues(?int $form_id): array {
		return array_map(function($value) use($form_id) {
			return [
				"label" => "[" . $value["index"] . "] " . $value["name"],
				"value" => $value["id"],
				"selected" => $value["id"] == $form_id
			];
		}, $this->repository->get("forms")->getAll());
	}

	/**
	 * @param int|null $field_id
	 * @return array
	 */
	protected function buildFieldsValues(?int $field_id): array {
		return array_map(function($value) use($field_id) {
			return [
				"label" => "[" . $value["index"] . "] " . $value["name"],
				"value" => $value["id"],
				"selected" => $value["id"] == $field_id
			];
		}, $this->repository->get("fields")->getAll());
	}

	/**
	 * @param null|Simple $topics
	 * @return array
	 */
	protected function buildTopicsTable(?Simple $topics): array {
		$result = [];

		/** @var CourseTopic $topic */
		foreach($topics as $topic) {
			$files = [];

			/** @var CourseTopicFile $file */
			foreach($topic->files as $file) {
				$files[] = [
					"id" => $file->id,
					"icon" => $file->icon,
					"url" => $file->url,
				];
			}

			$result[] = [
				"id" => $topic->id,
				"no" => $topic->no,
				"title" => $topic->title,
				"files" => $files,
			];
		}

		return $result;
	}

}
