<?php

use Phinx\Migration\AbstractMigration as Migration;

class UsersTableMigration extends Migration {

	/**
	 * @return void
	 */
	public function change(): void {
		$table = $this->table("users");

		$table->addColumn("login", "string");
		$table->addIndex("login", ["unique" => true]);
		$table->addColumn("email", "string");
		$table->addIndex("login", ["unique" => true]);
		$table->addColumn("password", "string");

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
