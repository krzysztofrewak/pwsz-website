<?php

namespace PWSZ\Controllers\Management;

use Exception;
use Phalcon\Http\Response;
use PWSZ\Controllers\Controller;

class LogsController extends Controller {

	/**
	 * @return Response
	 */
	public function getLogsAction(): Response {
		$logsDirectory = "../logs/";
		$files = scandir($logsDirectory);
		$files = array_filter($files, function(string $filename): bool {
			return !in_array($filename, [".", "..", ".gitignore", "test.log"]);
		});

		$logs = [];
		foreach($files as $file) {
			$content = file_get_contents($logsDirectory . $file);

			$day = [
				"date" => str_replace(".log", "", $file),
				"all" => sizeof(explode("\n", $content)) - 1,
			];

			foreach(["DEBUG", "INFO", "WARNING", "ALERT"] as $method) {
				$day[strtolower($method)] = substr_count($content, "[$method]");
			}

			$logs[] = $day;
		}

		$logs = array_reverse($logs);

		$this->responseArray->setData($logs);
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}

	/**
	 * @param string $log
	 * @return Response
	 */
	public function getLogAction(string $log): Response {
		$logsDirectory = "../logs/";

		try {
			$content = file_get_contents($logsDirectory . $log . ".log", true);
		} catch(Exception $e) {
			$this->responseArray->setMessage("Log not found")->setStatusCode(404);
			$this->logger->warning("Non-existing log { id: $log } requested and not delivered.");

			return $this->renderResponse();
		}

		$content = str_replace("\r", "", $content);
		$logs = explode("\n", $content);

		$logs = array_reverse($logs);
		$logs = array_filter($logs, function(string $log): bool {
			return strlen($log) > 0;
		});

		$logs = array_map(function(string $log): array {
			preg_match("/\[[^\]]*\]/", $log, $time);
			$log = str_replace($time, "", $log);
			preg_match("/\[[^\]]*\]/", $log, $ip);
			$log = str_replace($ip, "", $log);
			preg_match("/\[[^\]]*\]/", $log, $method);
			$log = str_replace($method, "", $log);

			return [
				"time" => substr($time[0], 1, -1),
				"ip" => substr($ip[0], 1, -1),
				"method" => substr($method[0], 1, -1),
				"message" => substr($log, 1),
			];
		}, $logs);

		$logs = array_values($logs);

		$this->responseArray->setData($logs);
		$this->responseArray->setSuccessStatus();

		return $this->renderResponse();
	}
	
}
