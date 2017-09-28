<?php

namespace PWSZ\Helpers;

class ResponseArray {

	public $success = false;
	public $message = "";
	public $redirect = null;
	public $data = [];

	public function __toString(): string {
		return json_encode($this);
	}

	public function get(): array {
		return [
			"success" => $this->success,
			"message" => $this->message,
			"redirect" => $this->redirect,
			"data" => $this->data
		];
	}

	public function setSuccessStatus(): self {
		$this->success = true;
		return $this;
	}

	public function setFailureStatus(): self {
		$this->success = false;
		return $this;
	}

	public function setMessage(string $message): self {
		$this->message = $message;
		return $this;
	}

	public function setRedirect(string $url): self {
		$this->redirect = $url;
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

}
