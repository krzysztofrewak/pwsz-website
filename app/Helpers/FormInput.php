<?php

namespace PWSZ\Helpers;

class FormInput {

	protected $type;
	protected $label;
	protected $name;
	protected $value;

	/**
	 * @param string $type
	 * @return FormInput
	 */
	public static function setType(string $type): self {
		$instance = new static;
		$instance->type = $type;

		return $instance;
	}

	/**
	 * @param string $label
	 * @return FormInput
	 */
	public function setLabel(string $label): self {
		$this->label = $label;
		return $this;
	}

	/**
	 * @param string $name
	 * @return FormInput
	 */
	public function setName(string $name): self {
		$this->name = $name;
		return $this;
	}

	/**
	 * @param callable $value
	 * @return FormInput
	 */
	public function setValue(callable $value): self {
		$this->value = $value;
		return $this;
	}

	/**
	 * @return array
	 */
	public function get(): array {
		return [
			"type" => $this->type,
			"label" => $this->label,
			"name" => $this->name,
			"value" => call_user_func($this->value),
		];
	}

}
