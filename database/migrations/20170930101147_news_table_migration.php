<?php

use Phinx\Migration\AbstractMigration as Migration;

class NewsTableMigration extends Migration {

	public function change() {
		$table = $this->table("news");

		$table->addColumn("title", "string");
		$table->addColumn("content", "text");

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
