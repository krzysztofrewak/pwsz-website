<?php

namespace PWSZ\Tests;

use Behat\Gherkin\Node\TableNode;
use Phalcon\Http\Response;
use PWSZ\Helpers\ResponseArray;
use PHPUnit\Framework\Assert as PHPUnit;

abstract class AccessContext extends Context {

	/**
	 * @var Response;
	 */
	protected $response;

	/**
	 * @var ResponseArray
	 */
	protected $responseArray;

	/**
	 * @When a client requests :arg1
	 * @When a client requests :arg1 with :arg2 method
	 * @param string $path
	 * @param string $method
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

	/**
	 * @Then :arg1 status code should be received
	 * @param string $statusCode
	 */
	public function statusCodeShouldBeReceived(string $statusCode): void {
		PHPUnit::assertEquals((string) $this->response->getStatusCode(), $statusCode);
	}

	/**
	 * @Then proper response array should be received
	 */
	public function properResponseArrayShouldBeReceived(): void {
		$model_response_array = (new ResponseArray())->get();
		$received_response_array = (array) $this->responseArray;

		PHPUnit::assertEquals(count($received_response_array), count($model_response_array));

		foreach($model_response_array as $key => $value) {
			PHPUnit::assertTrue(array_key_exists($key, $received_response_array));
		}
	}

	/**
	 * @Then response array should not have success status
	 */
	public function responseArrayShouldNotHaveSuccessStatus(): void {
		PHPUnit::assertFalse($this->responseArray->success);
	}

	/**
	 * @Then response array should have success status
	 */
	public function responseArrayShouldHaveSuccessStatus(): void {
		PHPUnit::assertTrue($this->responseArray->success);
	}

	/**
	 * @Then response array should have empty data array
	 */
	public function responseArrayShouldHaveEmptyDataArray(): void {
		PHPUnit::assertEmpty($this->responseArray->data);
	}

	/**
	 * @Then response array should not have empty data array
	 */
	public function responseArrayShouldNotHaveEmptyDataArray(): void {
		PHPUnit::assertNotEmpty($this->responseArray->data);
	}

	/**
	 * @Then response array should have empty message
	 */
	public function responseArrayShouldHaveEmptyMessage(): void {
		PHPUnit::assertEquals($this->responseArray->message, "");
	}

	/**
	 * @Then response array should have message
	 */
	public function responseArrayShouldHaveMessage(): void {
		PHPUnit::assertNotEquals($this->responseArray->message, "");
	}

	/**
	 * @Then response array data should have following values:
	 * @param TableNode $table
	 */
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

	/**
	 * @Then there should be :arg1 entries
	 * @Then there should be :arg1 news entries
	 * @Then there should be :arg1 consultation entries
	 * @param int $expectedNumberOfEntries
	 */
	public function thereShouldBeEntries(int $expectedNumberOfEntries): void {
		PHPUnit::assertGreaterThanOrEqual(count($this->responseArray->data), $expectedNumberOfEntries);
	}

	/**
	 * @Then logger have logged messages:
	 * @param TableNode $table
	 */
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
