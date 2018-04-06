<?php

use Phinx\Migration\AbstractMigration as Migration;

class CourseTopicsTableMigration extends Migration {

	public function change() {
		$table = $this->table("course_topics");

		$table->addColumn("title", "string");
		$table->addColumn("no", "string");

		$table->addColumn("course_id", "integer");
		$table->addForeignKey("course_id", "courses", "id", ["delete" => "CASCADE", "update" => "NO_ACTION"]);

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
