<?php

namespace PWSZ\Helpers;

class FormInput {

	protected $type;
	protected $label;
	protected $name;
	protected $value;

	public static function setType(string $type): self {
		$instance = new static;
		$instance->type = $type;

		return $instance;
	}

	public function setLabel(string $label): self {
		$this->label = $label;
		return $this;
	}

	public function setName(string $name): self {
		$this->name = $name;
		return $this;
	}

	public function setValue(callable $value): self {
		$this->value = $value;
		return $this;
	}

	public function get(): array {
		return [
			"type" => $this->type,
			"label" => $this->label,
			"name" => $this->name,
			"value" => call_user_func($this->value)
		];
	}

}
