<?php

use Phalcon\Mvc\Router;
use PWSZ\Helpers\Route as R;

$router = new Router(false);
$router->removeExtraSlashes(true);
$router->setUriSource(Router::URI_SOURCE_SERVER_REQUEST_URI);

$auth_status = !is_null($di->get("session")->get("auth"));

$namespace = "PWSZ\\Controllers";

{

	$router->notFound(R::get("notFound", "Index", $namespace));

	$router->addGet("/api", R::get("index", "Index", $namespace));

	$router->addGet("/api/news", R::get("getNews", "News", $namespace));
	$router->addGet("/api/news/{id}", R::get("getEntry", "News", $namespace));

	$router->addGet("/api/courses", R::get("getCourses", "Courses", $namespace));
	$router->addGet("/api/courses/{id}", R::get("getEntry", "Courses", $namespace));

	$router->addGet("/api/faq", R::get("getQuestions", "Faq", $namespace));

	$router->addGet("/api/grades", R::get("getGrades", "Grades", $namespace));
	$router->addGet("/api/grades/semesters", R::get("getSemesters", "Grades", $namespace));
	$router->addGet("/api/grades/courses", R::get("getCourses", "Grades", $namespace));
	$router->addGet("/api/grades/groups", R::get("getGroups", "Grades", $namespace));

	$router->addGet("/api/auth", R::get("check", "Authentication", $namespace));
	$router->addPost("/api/auth", R::get("check", "Authentication", $namespace));
	$router->addPost("/api/login", R::get("login", "Authentication", $namespace, !$auth_status));
	$router->addPost("/api/logout", R::get("logout", "Authentication", $namespace, $auth_status));

}

$namespace = "PWSZ\\Controllers\\Management";

{
	$router->addPost("/api/management", R::get("update", "Update", $namespace, $auth_status));
	$router->addDelete("/api/management/{repository_name}/{id}", R::get("delete", "Delete", $namespace, $auth_status));

	$router->addGet("/api/management/user", R::get("get", "User", $namespace, $auth_status));
	$router->addPost("/api/management/user", R::get("update", "User", $namespace, $auth_status));

	$router->addGet("/api/management/grades", R::get("getGrades", "Grades", $namespace, $auth_status));
	$router->addGet("/api/management/grades/semesters", R::get("getSemesters", "Grades", $namespace, $auth_status));
	$router->addGet("/api/management/grades/courses", R::get("getCourses", "Grades", $namespace, $auth_status));
	$router->addGet("/api/management/grades/groups", R::get("getGroups", "Grades", $namespace, $auth_status));
	$router->addPost("/api/management/coursegroups/students", R::get("updateStudentsInGroup", "GroupStudents", $namespace, $auth_status));
}

$namespace = "PWSZ\\Controllers\\Management\\CRUD";

{
	$modules = [
		"news" => "News",
		"faqs" => "Faq",
		"fields" => "Field",
		"forms" => "Form",
		"semesters" => "Semester",
		"courses" => "Course",
		"students" => "Student",
		"semestercourses" => "SemesterCourse",
		"coursegroups" => "CourseGroup",
	];

	foreach($modules as $url => $controller) {
		$router->addGet("/api/management/". $url, R::get("list", $controller, $namespace, $auth_status));
		$router->addGet("/api/management/". $url ."/form", R::get("addForm", $controller, $namespace, $auth_status));
		$router->addGet("/api/management/". $url ."/form/{id}", R::get("editForm", $controller, $namespace, $auth_status));
	}
}

return $router;
