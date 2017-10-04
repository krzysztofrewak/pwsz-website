<?php

use Phinx\Migration\AbstractMigration as Migration;

class StudentClassesTableMigration extends Migration {

	public function change() {
		$table = $this->table("student_classes");

		$table->addColumn("was_present", "boolean", ["null" => true, "default" => null]);
		$table->addColumn("value", "string", ["default" => ""]);

		$table->addColumn("group_student_id", "integer");
		$table->addForeignKey("group_student_id", "group_students", "id", ["delete"=> "CASCADE", "update"=> "NO_ACTION"]);

		$table->addColumn("class_id", "integer");
		$table->addForeignKey("class_id", "semester_course_classes", "id", ["delete"=> "CASCADE", "update"=> "NO_ACTION"]);

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
