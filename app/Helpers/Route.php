<?php

namespace PWSZ\Helpers;

class Route {

	public static function get(string $action, string $controller, string $namespace, bool $allow = true): array {
		if(!$allow) {
			return self::get("noAccess", "Index", "PWSZ\\Controllers");
		}

		return [
			"namespace" => $namespace,
			"controller" => $controller,
			"action" => $action
		];
	}

}
