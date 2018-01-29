<?php

use Phalcon\Mvc\Router;

$router = new Router(false);
$router->removeExtraSlashes(true);
$router->setUriSource(Router::URI_SOURCE_SERVER_REQUEST_URI);

$authenticated = !is_null($di->get("session")->get("auth"));

function r(string $action, string $controller, string $namespace = "PWSZ\\Controllers"): array {
	return [
		"namespace" => $namespace,
		"controller" => $controller,
		"action" => $action
	];
}

function ac(array $route_array, bool $allowed_for_authenticated): array {
	return $allowed_for_authenticated ? $route_array : r("noAccess", "Index");
}

$router->notFound(r("notFound", "Index"));

$router->addGet("/api", r("index", "Index"));

$router->addGet("/api/news", r("getNews", "News"));
$router->addGet("/api/news/{id}", r("getEntry", "News"));

$router->addGet("/api/courses", r("getCourses", "Courses"));
$router->addGet("/api/courses/{id}", r("getEntry", "Courses"));

$router->addGet("/api/faq", r("getQuestions", "Faq"));

$router->addPost("/api/grades", r("getGrades", "Grades"));
$router->addPost("/api/grades/semesters", r("getSemesters", "Grades"));
$router->addPost("/api/grades/courses", r("getCourses", "Grades"));
$router->addPost("/api/grades/groups", r("getGroups", "Grades"));

$router->addGet("/api/auth", r("check", "Authentication"));
$router->addPost("/api/auth", r("check", "Authentication"));
$router->addPost("/api/login", ac(r("login", "Authentication"), !$authenticated));
$router->addPost("/api/logout", ac(r("logout", "Authentication"), $authenticated));

$namespace = "PWSZ\\Controllers\\Management";

$router->addPost("/api/management", ac(r("update", "Update", $namespace), $authenticated));

$modules = [
	"fields" => "Field",
	"forms" => "Form",
	"semesters" => "Semester",
	"courses" => "Course",
];

foreach($modules as $url => $controller) {
	$router->addGet("/api/management/". $url, ac(r("list", $controller, $namespace), $authenticated));
	$router->addGet("/api/management/". $url ."/{id}", ac(r("form", $controller, $namespace), $authenticated));
}

return $router;
