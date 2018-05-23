<?php

namespace PWSZ\Helpers;

class ResponseArray {

	/**
	 * HTTP status
	 * @var int
	 */
	protected $status;

	/**
	 * Authentication status
	 * @var bool
	 */
	public $auth = false;

	/**
	 * Action status
	 * @var bool
	 */
	public $success = false;

	/**
	 * Response message for notification
	 * @var string
	 */
	public $message = "";

	/**
	 * Data array
	 * @var array
	 */
	public $data = [];

	/**
	 * @return string
	 */
	public function __toString(): string {
		return json_encode($this);
	}

	/**
	 * @return array
	 */
	public function get(): array {
		return [
			"auth" => $this->auth,
			"success" => $this->success,
			"message" => $this->message,
			"data" => $this->data,
		];
	}

	/**
	 * @param bool $authStatus
	 * @return ResponseArray
	 */
	public function setAuthenticationStatus(bool $authStatus): self {
		$this->auth = $authStatus;
		return $this;
	}

	/**
	 * @return ResponseArray
	 */
	public function setSuccessStatus(): self {
		$this->success = true;
		$this->status = 200;
		return $this;
	}

	/**
	 * @return ResponseArray
	 */
	public function setFailureStatus(): self {
		$this->success = false;
		$this->status = 500;
		return $this;
	}

	/**
	 * @param string $message
	 * @return ResponseArray
	 */
	public function setMessage(string $message): self {
		$this->message = $message;
		return $this;
	}

	/**
	 * @param array $data
	 * @return ResponseArray
	 */
	public function setData(array $data): self {
		$this->data = $data;
		return $this;
	}

	/**
	 * @param int $status
	 * @return ResponseArray
	 */
	public function setStatusCode(int $status): self {
		$this->status = $status;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getStatusCode(): int {
		if($this->status) {
			return $this->status;
		}

		return $this->success ? 200 : 500;
	}

}
