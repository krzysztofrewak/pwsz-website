<?php

use Phalcon\Mvc\Router;

$router = new Router(false);
$router->removeExtraSlashes(true);
$router->setUriSource(Router::URI_SOURCE_SERVER_REQUEST_URI);

function r(string $action, string $controller, string $namespace = "PWSZ\\Controllers"): array {
	return [
		"namespace" => $namespace,
		"controller" => $controller,
		"action" => $action
	];
}

$router->notFound(r("notFound", "Index"));

$router->addGet("/api", r("index", "Index"));
$router->addGet("/api/news", r("getNews", "News"));
$router->addGet("/api/courses", r("getCourses", "Courses"));

return $router;
