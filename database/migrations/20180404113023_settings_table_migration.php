<?php

use Phinx\Migration\AbstractMigration as Migration;

class SettingsTableMigration extends Migration {

	public function change() {
		$table = $this->table("settings");

		$table->addColumn("key", "string");
		$table->addIndex("key", ["unique" => true]);
		$table->addColumn("value", "string", ["default" => ""]);

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
