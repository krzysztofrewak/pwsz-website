<?php

use Phinx\Migration\AbstractMigration as Migration;

class CourseGroupStudentsTableMigration extends Migration {

	public function change() {
		$table = $this->table("course_group_students");

		$table->addColumn("student_id", "integer");
		$table->addForeignKey("student_id", "students", "id", ["delete"=> "CASCADE", "update"=> "NO_ACTION"]);

		$table->addColumn("course_group_id", "integer");
		$table->addForeignKey("course_group_id", "course_groups", "id", ["delete"=> "CASCADE", "update"=> "NO_ACTION"]);

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
