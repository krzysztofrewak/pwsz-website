<?php

namespace PWSZ\Repositories;

use Carbon\Carbon;
use Phalcon\Mvc\Model\ResultsetInterface;
use PWSZ\Helpers\DateTimeTranslator;
use PWSZ\Interfaces\ModelInterface as Model;
use PWSZ\Models\Consultation;

class Consultations extends Repository {

	/**
	 * @return ResultsetInterface
	 */
	protected function getObjects(): ResultsetInterface {
		return $this->getModelClass()::find(["order" => "datetime ASC"]);
	}

	/**
	 * @return Consultation
	 */
	public function getModelClass(): string {
		return Consultation::class;
	}

	/**
	 * @param Model $consultation
	 * @return array
	 */
	public function map(Model $consultation): array {
		/** @var Consultation $consultation */

		$date = Carbon::parse($consultation->datetime);

		return [
			"id" => $consultation->id,
			"datetime" => $consultation->datetime,
			"date" => DateTimeTranslator::getRealDate($consultation->datetime),
			"hour" => $date->hour,
			"minute" => $date->minute,
			"place" => $consultation->place,
			"is_active" => !$date->lessThan(Carbon::now()),
		];
	}

}
