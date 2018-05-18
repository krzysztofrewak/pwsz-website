<?php

namespace PWSZ\Tests;

use Behat\Gherkin\Node\TableNode;
use PWSZ\Models\Consultation;
use PWSZ\Models\News;
use PHPUnit\Framework\Assert as PHPUnit;

class FrontyardContext extends AccessContext {

	/**
	 * @Given a set of existing news in database:
	 * @param TableNode $table
	 */
	public function aSetOfExistingNewsInDatabase(TableNode $table): void {
		$hash = $table->getHash();

		foreach($hash as $row) {
			$news = new News();
			$news->id = $row["id"];
			$news->title = $row["title"];
			$news->content = $row["content"];
			$news->created_at = $row["created_at"];
			$news->save();
		}
	}

	/**
	 * @Then received news should be arranged in chronological order
	 */
	public function receivedNewsShouldBeArrangedInChronologicalOrder(): void {
		$comparer = null;

		foreach($this->responseArray->data as $news) {
			if(is_null($comparer)) {
				$comparer = $news->timestamp;
			}
			PHPUnit::assertGreaterThanOrEqual($news->timestamp, $comparer);
		}
	}

	/**
	 * @Given /^a set of existing consultations in database:$/
	 * @param TableNode $table
	 */
	public function aSetOfExistingConsultationsInDatabase(TableNode $table) {
		$hash = $table->getHash();

		foreach($hash as $row) {
			$consultation = new Consultation();
			$consultation->id = $row["id"];
			$consultation->datetime = $row["datetime"];
			$consultation->place = $row["place"];
			$consultation->save();
		}
	}

	/**
	 * @Given /^received consultation should be arranged in chronological order$/
	 */
	public function receivedConsultationShouldBeArrangedInChronologicalOrder() {
		$comparer = null;

		foreach($this->responseArray->data as $consultation) {
			if(is_null($comparer)) {
				$comparer = $consultation->datetime;
			}
			PHPUnit::assertLessThanOrEqual($consultation->datetime, $comparer);
		}
	}


}
