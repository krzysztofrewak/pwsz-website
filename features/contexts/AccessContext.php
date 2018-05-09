<?php

namespace PWSZ\Tests;

use Behat\Gherkin\Node\TableNode;
use Carbon\Carbon;
use PWSZ\Helpers\ResponseArray;
use PWSZ\Models\News;
use PHPUnit\Framework\Assert as PHPUnit;

class AccessContext extends Context {

	private $response;
	private $responseArray = [];

	/** 
	 * @When a client requests :arg1
	 * @When a client requests :arg1 with :arg2 method
	 */
	public function aClientRequestsWithMethod(string $path, string $method = "GET"): void {
		$_SERVER['REQUEST_METHOD'] = $method;
		
		$router = self::$di->get("router");
		$router->handle($path);

		$dispatcher = self::$di->get("dispatcher");

		$dispatcher->setControllerName($router->getControllerName());
		$dispatcher->setActionName($router->getActionName());
		$dispatcher->setNamespaceName($router->getNamespaceName());
		$dispatcher->setParams($router->getParams());

		$dispatcher->dispatch();

		$this->response = $dispatcher->getReturnedValue();
		$this->responseArray = json_decode($this->response->getContent());
	}

	/** @Then :arg1 status code should be received */
	public function statusCodeShouldBeReceived(string $statusCode): void {
		PHPUnit::assertEquals((string) $this->response->getStatusCode(), $statusCode);
	}

	/** @Then proper response array should be received */
	public function properResponseArrayShouldBeReceived(): void {
		$model_response_array = (new ResponseArray())->get();
		$received_response_array = (array) $this->responseArray;

		PHPUnit::assertEquals(count($received_response_array), count($model_response_array));

		foreach($model_response_array as $key => $value) {
			PHPUnit::assertTrue(array_key_exists($key, $received_response_array));
		}
	}

	/** @Then response array should not have success status */
	public function responseArrayShouldNotHaveSuccessStatus(): void {
		PHPUnit::assertFalse($this->responseArray->success);
	}

	/** @Then response array should have success status */
	public function responseArrayShouldHaveSuccessStatus(): void {
		PHPUnit::assertTrue($this->responseArray->success);
	}

	/** @Then response array should have empty data array */
	public function responseArrayShouldHaveEmptyDataArray(): void {
		PHPUnit::assertEmpty($this->responseArray->data);
	}

	/** @Then response array should not have empty data array */
	public function responseArrayShouldNotHaveEmptyDataArray(): void {
		PHPUnit::assertNotEmpty($this->responseArray->data);
	}

	/** @Then response array should have empty message */
	public function responseArrayShouldHaveEmptyMessage(): void {
		PHPUnit::assertEquals($this->responseArray->message, "");
	}

	/** @Then response array should have message */
	public function responseArrayShouldHaveMessage(): void {
		PHPUnit::assertNotEquals($this->responseArray->message, "");
	}

	/** @Then response array data should have following values: */
	public function responseArrayDataShouldHaveFollowingValues(TableNode $table): void {
		$response_array = (array) $this->responseArray->data;
		$hash = $table->getHash();

		foreach($hash as $row) {
			PHPUnit::assertEquals($row["id"], $response_array["id"]);
			PHPUnit::assertEquals($row["title"], $response_array["title"]);
			PHPUnit::assertEquals($row["content"], $response_array["content"]);
			PHPUnit::assertEquals($row["timestamp"], $response_array["timestamp"]);
		}
	}

	/** @Given a set of existing news in database: */
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

	/** @Then there should be :arg1 news entries */
	public function thereShouldBeNewsEntries(int $expectedNumberOfNews): void {
		PHPUnit::assertGreaterThanOrEqual(count($this->responseArray->data), $expectedNumberOfNews);
	}

	/** @Then received news should be arranged in chronological order */
	public function receivedNewsShouldBeArrangedInChronologicalOrder(): void {
		$comparer = null;

		foreach($this->responseArray->data as $news) {
			if(is_null($comparer)) {
				$comparer = $news->timestamp;
			}
			PHPUnit::assertGreaterThanOrEqual($news->timestamp, $comparer);
		}
	}

	/** @Then logger have logged messages: */
	public function loggerHaveLoggedMessages(TableNode $table): void {
		$file = file(self::TEST_LOG_FILNAME);

		$logMessages = [];
		$logMessagesCount = 0;
		foreach($file as $row) {
			$type = trim($row);
			!isset($logMessages[$type]) ? $logMessages[$type] = 1 : $logMessages[$type]++;
			$logMessagesCount++;
		}

		$hash = $table->getHash();

		$testMessages = [];
		$testMessagesCount = 0;
		foreach($hash as $row) {
			$type = strtoupper($row["type"]);
			!isset($testMessages[$type]) ? $testMessages[$type] = $row["count"] : $testMessages[$type] += $row["count"];
			$testMessagesCount++;
		}

		PHPUnit::assertEquals($logMessagesCount, $testMessagesCount);
		PHPUnit::assertEmpty(array_diff_assoc($logMessages, $testMessages));
	}

	
}
