<?php

use Phalcon\Mvc\Router;
use PWSZ\Helpers\Route as R;

$router = new Router(false);
$router->removeExtraSlashes(true);
$router->setUriSource(Router::URI_SOURCE_SERVER_REQUEST_URI);

/** @var bool $auth_status */
$auth_status = !is_null($di->get("session")->get("auth"));

$namespace = "PWSZ\\Controllers";

{
	$router->notFound(R::get("notFound", "index", $namespace));

	$router->addGet("/")->setName("home");
	$router->addGet("/api", R::get("index", "index", $namespace));

	$router->addGet("/api/news", R::get("getNews", "news", $namespace));
	$router->addGet("/api/news/{id}", R::get("getEntry", "news", $namespace))->setName("news");
	$router->addGet("/api/news/rss", R::get("getRss", "news", $namespace));

	$router->addGet("/api/courses", R::get("getCourses", "courses", $namespace));
	$router->addGet("/api/courses/{id}", R::get("getEntry", "courses", $namespace));

	$router->addGet("/api/faq", R::get("getQuestions", "faq", $namespace));

	$router->addGet("/api/grades", R::get("getGrades", "grades", $namespace));
	$router->addGet("/api/grades/semesters", R::get("getSemesters", "grades", $namespace));
	$router->addGet("/api/grades/courses", R::get("getCourses", "grades", $namespace));
	$router->addGet("/api/grades/groups", R::get("getGroups", "grades", $namespace));

	$router->addGet("/api/consultations", R::get("getConsultations", "consultations", $namespace));

	$router->addGet("/api/auth", R::get("check", "authentication", $namespace));
	$router->addPost("/api/auth", R::get("check", "authentication", $namespace));
	$router->addPost("/api/login", R::get("login", "authentication", $namespace, !$auth_status));
	$router->addPost("/api/logout", R::get("logout", "authentication", $namespace, $auth_status));
}

$namespace = "PWSZ\\Controllers\\Management";

{
	$router->addPost("/api/management", R::get("update", "update", $namespace, $auth_status));
	$router->addDelete("/api/management/{repository_name}/{id}", R::get("delete", "delete", $namespace, $auth_status));

	$router->addGet("/api/management/user", R::get("get", "user", $namespace, $auth_status));
	$router->addPost("/api/management/user", R::get("update", "user", $namespace, $auth_status));

	$router->addGet("/api/management/logs", R::get("getLogs", "logs", $namespace, $auth_status));
	$router->addGet("/api/management/logs/{log}", R::get("getLog", "logs", $namespace, $auth_status));

	$router->addGet("/api/management/grades", R::get("getGrades", "grades", $namespace, $auth_status));
	$router->addGet("/api/management/grades/semesters", R::get("getSemesters", "grades", $namespace, $auth_status));
	$router->addGet("/api/management/grades/courses", R::get("getCourses", "grades", $namespace, $auth_status));
	$router->addGet("/api/management/grades/groups", R::get("getGroups", "grades", $namespace, $auth_status));
	$router->addPost("/api/management/coursegroups/students", R::get("updateStudentsInGroup", "group_students", $namespace, $auth_status));
}

$namespace = "PWSZ\\Controllers\\Management\\CRUD";

{
	$modules = [
		"news" => "news",
		"faqs" => "faq",
		"modes" => "mode",
		"fields" => "field",
		"forms" => "form",
		"semesters" => "semester",
		"courses" => "course",
		"students" => "student",
		"semesterCourses" => "semester-course",
		"courseGroups" => "course-group",
	];

	foreach($modules as $url => $controller) {
		$router->addGet("/api/management/". $url, R::get("list", $controller, $namespace, $auth_status));
		$router->addGet("/api/management/". $url ."/form", R::get("addForm", $controller, $namespace, $auth_status));
		$router->addGet("/api/management/". $url ."/form/{id}", R::get("editForm", $controller, $namespace, $auth_status));
	}
}

return $router;
