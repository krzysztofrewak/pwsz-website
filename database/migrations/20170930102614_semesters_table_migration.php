<?php

use Phinx\Migration\AbstractMigration as Migration;

class SemestersTableMigration extends Migration {

	public function change() {
		$table = $this->table("semesters");

		$table->addColumn("name", "string");

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
