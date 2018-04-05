<?php

namespace PWSZ\Behat;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Assert as PHPUnit;

class AccessContext extends Context {

	private $response;
	private $responseArray = [];

	/** @When the Guzzle client requests :arg1 with :arg2 method */
	public function theGuzzleClientRequestsWithMethod(string $path, string $method = "GET"): void {
		$client = new Client(["http_errors" => false]);
		$this->response = $client->request($method, getenv("APP_URL") . $path);
		$this->responseArray = json_decode($this->response->getBody()->getContents());
	}

	/** @Then :arg1 status code should be received */
	public function statusCodeShouldBeReceived(string $statusCode): void {
		PHPUnit::assertEquals((string) $this->response->getStatusCode(), $statusCode);
	}

	/** @Then response array has no success status */
	public function responseArrayHasNoSuccessStatus() {
		PHPUnit::assertFalse($this->responseArray->success);
	}

	/** @Then response array has success status */
	public function responseArrayHasSuccessStatus() {
		PHPUnit::assertTrue($this->responseArray->success);
	}

}
