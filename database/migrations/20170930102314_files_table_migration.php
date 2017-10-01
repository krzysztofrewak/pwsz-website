<?php

use Phinx\Migration\AbstractMigration as Migration;

class FilesTableMigration extends Migration {

	public function change() {
		$table = $this->table("files");

		$table->addColumn("url", "string");
		$table->addColumn("icon", "string");

		$table->addColumn("topic_id", "integer");
		$table->addForeignKey("topic_id", "topics", "id", ["delete" => "CASCADE", "update" => "NO_ACTION"]);

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
