<?php

namespace PWSZ\Models;

class Consultation extends Model {

	public $id;
	public $datetime;
	public $place;

	public function initialize(): void {
		$this->setSource("consultations");
	}

}
