<?php

use Phinx\Migration\AbstractMigration as Migration;

class FormsTableMigration extends Migration {

	/**
	 * @return void
	 */
	public function change(): void {
		$table = $this->table("forms");

		$table->addColumn("index", "string");
		$table->addColumn("name", "string");

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
