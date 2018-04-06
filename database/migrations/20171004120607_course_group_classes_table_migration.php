<?php

use Phinx\Migration\AbstractMigration as Migration;

class CourseGroupClassesTableMigration extends Migration {

	public function change() {
		$table = $this->table("course_group_classes");

		$table->addColumn("name", "string");

		$table->addColumn("course_group_id", "integer");
		$table->addForeignKey("course_group_id", "course_groups", "id", ["delete"=> "CASCADE", "update"=> "NO_ACTION"]);

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
