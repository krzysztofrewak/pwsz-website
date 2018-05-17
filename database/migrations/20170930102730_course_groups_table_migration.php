<?php

use Phinx\Migration\AbstractMigration as Migration;

class CourseGroupsTableMigration extends Migration {

	/**
	 * @return void
	 */
	public function change(): void {
		$table = $this->table("course_groups");

		$table->addColumn("name", "string");

		$table->addColumn("semester_course_id", "integer");
		$table->addForeignKey("semester_course_id", "semester_courses", "id", ["delete"=> "CASCADE", "update"=> "NO_ACTION"]);

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
