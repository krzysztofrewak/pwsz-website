<?php

namespace PWSZ\Helpers;

class ResponseArray {

	protected $status;
	public $success = false;
	public $message = "";
	public $data = [];

	public function __toString(): string {
		return json_encode($this);
	}

	public function get(): array {
		return [
			"success" => $this->success,
			"message" => $this->message,
			"data" => $this->data
		];
	}

	public function setSuccessStatus(): self {
		$this->success = true;
		$this->status = 200;
		return $this;
	}

	public function setFailureStatus(): self {
		$this->success = false;
		$this->status = 500;
		return $this;
	}

	public function setMessage(string $message): self {
		$this->message = $message;
		return $this;
	}

	public function pushData(string $key, $value): self {
		$this->data[$key] = $value;
		return $this;
	}

	public function setData(array $data): self {
		$this->data = $data;
		return $this;
	}

	public function setStatusCode(int $status): self {
		$this->status = $status;
		return $this;
	}

	public function getStatusCode(): int {
		if($this->status) {
			return $this->status;
		}

		return $this->success ? 200 : 500;
	}

}
