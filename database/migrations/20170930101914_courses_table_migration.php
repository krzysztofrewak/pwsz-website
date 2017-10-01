<?php

use Phinx\Migration\AbstractMigration as Migration;

class CoursesTableMigration extends Migration {

	public function change() {
		$table = $this->table("courses");

		$table->addColumn("index", "string");
		$table->addColumn("name", "string");

		$table->addColumn("field_id", "integer");
		$table->addForeignKey("field_id", "fields", "id", ["delete" => "CASCADE", "update" => "NO_ACTION"]);

		$table->addColumn("semester_no", "integer");

		$table->addColumn("form_id", "integer");
		$table->addForeignKey("form_id", "forms", "id", ["delete" => "CASCADE", "update" => "NO_ACTION"]);

		$table->addColumn("rules", "text");
		$table->addColumn("is_active", "boolean", ["default" => false]);

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
