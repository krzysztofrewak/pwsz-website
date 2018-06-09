<?php

namespace PWSZ\Controllers;

use Phalcon\Http\Response;
use Phalcon\Mvc\Url;
use PWSZ\Exceptions\NotFound;
use SimpleXMLElement;

class NewsController extends Controller {

	/**
	 * @return Response
	 */
	public function getNewsAction(): Response {
		$news = $this->repository->get("news")->getAll();

		$this->responseArray->setData($news)->setSuccessStatus();
		$this->logger->info("News reel requested and delivered.");

		return $this->renderResponse();
	}

	/**
	 * @return Response
	 */
	public function getRssAction(): Response {
		$news = $this->repository->get("news")->getAll();

		$xml = new SimpleXMLElement("<xml/>");
		$this->url->setBaseUri(getenv("APP_URL"));

		$channel = $xml->addChild("channel");
		$channel->addChild("title", "Krzysztof Rewak");
		$channel->addChild("link", $this->url->get(["for" => "home"]));
		$channel->addChild("language", "pl");

		foreach($news as $entry) {
			$item = $channel->addChild("item");
			$item->addChild("title", $entry["title"]);
			$item->addChild("description", $entry["content"]);
			$item->addChild("link", $this->url->get(["for" => "news", "id" => $entry["id"]]));
			$item->addChild("pubDate", $entry["timestamp"]);
		}

		$this->response->setHeader("Content-Type", "application/xml+rss");
		$this->response->setContent($xml->asXML());

		return $this->response;
	}

	/**
	 * @param string $id
	 * @return Response
	 */
	public function getEntryAction(string $id): Response {
		$id = (int) $id;

		try {
			$news = $this->repository->get("news")->getById($id);
		} catch(NotFound $exception) {
			$this->responseArray->setMessage("News not found")->setStatusCode(400);
			$this->logger->warning("Non-existing news { id: $id } requested and not delivered.");

			return $this->renderResponse();
		}

		$this->responseArray->setData($news)->setSuccessStatus();
		$this->logger->info("News { id: $id } requested and delivered.");

		return $this->renderResponse();
	}

}
