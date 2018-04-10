<?php

namespace PWSZ\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
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

		$dispatcher->dispatch();

		$this->response = $dispatcher->getReturnedValue();
		$this->responseArray = json_decode($this->response->getContent());
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
