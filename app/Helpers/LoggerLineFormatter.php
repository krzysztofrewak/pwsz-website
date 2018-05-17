<?php

namespace PWSZ\Helpers;

use Phalcon\Logger\Formatter;
use Carbon\Carbon;

class LoggerLineFormatter extends Formatter {

	/**
	 * @param string $message
	 * @param int $type
	 * @param int $timestamp
	 * @param mixed $context
	 * @return string|array
	 */
	public function format($message, $type, $timestamp, $context = null) {
		$blocks = [
			Carbon::createFromTimestamp($timestamp)->format("Y-m-d H:i:s"),
			isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : "local",
			$this->getTypeString($type),
		];

		return implode("", array_map(function($block) {
			return "[". $block ."]";
		}, $blocks)) ." ". $message . PHP_EOL;
	}

}
