<?php

namespace PWSZ\Helpers;

class ResponseArray {

	/**
	 * @var
	 */
	protected $status;
	/**
	 * @var bool
	 */
	public $success = false;
	/**
	 * @var string
	 */
	public $message = "";
	/**
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
			"success" => $this->success,
			"message" => $this->message,
			"data" => $this->data,
		];
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
