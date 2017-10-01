<?php

namespace PWSZ\Repositories;

use PWSZ\Models\Faq;

class Faqs extends Repository {

	public function getModelClass(): string {
		return Faq::class;
	}

	public function map($model): array {
		return [
			"id" => $model->id,
			"question" => $model->question,
			"answer" => $model->answer
		];
	}

}
