<?php

use Phinx\Migration\AbstractMigration as Migration;

class StudentsTableMigration extends Migration {

	public function change() {
		$table = $this->table("students");

		$table->addColumn("student_no", "string");
		$table->addColumn("name", "string");

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
