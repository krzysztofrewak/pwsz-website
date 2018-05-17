<?php

namespace PWSZ\Repositories;

use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\Faq;

class Faqs extends Repository {

	/**
	 * @return Faq
	 */
	public function getModelClass(): string {
		return Faq::class;
	}

	/**
	 * @param Model $faq
	 * @return array
	 */
	public function map(Model $faq): array {
		/** @var Faq $faq */
		return [
			"id" => $faq->id,
			"question" => $faq->question,
			"answer" => $faq->answer
		];
	}

}
