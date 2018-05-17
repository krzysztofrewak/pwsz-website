<?php

use Phinx\Migration\AbstractMigration as Migration;

class SemesterCoursesTableMigration extends Migration {

	/**
	 * @return void
	 */
	public function change(): void {
		$table = $this->table("semester_courses");

		$table->addColumn("semester_id", "integer");
		$table->addForeignKey("semester_id", "semesters", "id", ["delete"=> "CASCADE", "update"=> "NO_ACTION"]);

		$table->addColumn("course_id", "integer");
		$table->addForeignKey("course_id", "courses", "id", ["delete"=> "CASCADE", "update"=> "NO_ACTION"]);

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
