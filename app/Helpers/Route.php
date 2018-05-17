<?php

namespace PWSZ\Helpers;

/**
 * Class Route
 * @package PWSZ\Helpers
 */
class Route {

	/**
	 * @param string $action
	 * @param string $controller
	 * @param string $namespace
	 * @param bool $allow
	 * @return array
	 */
	public static function get(string $action, string $controller, string $namespace, bool $allow = true): array {
		if(!$allow) {
			return self::get("noAccess", "Index", "PWSZ\\Controllers");
		}

		return [
			"namespace" => $namespace,
			"controller" => $controller,
			"action" => $action,
		];
	}

}
