<?php

namespace PWSZ\Models;

class Faq extends Model {

	public $id;
	public $question;
	public $answer;

	public function initialize(): void {
		$this->setSource("faqs");
	}
	
}
