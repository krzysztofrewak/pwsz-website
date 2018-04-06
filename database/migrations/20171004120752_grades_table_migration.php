<?php

use Phinx\Migration\AbstractMigration as Migration;

class GradesTableMigration extends Migration {

	public function change() {
		$table = $this->table("grades");

		$table->addColumn("was_present", "boolean", ["null" => true, "default" => null]);
		$table->addColumn("value", "string", ["default" => ""]);
		$table->addColumn("comment", "string", ["default" => ""]);

		$table->addColumn("course_group_student_id", "integer");
		$table->addForeignKey("course_group_student_id", "course_group_students", "id", ["delete"=> "CASCADE", "update"=> "NO_ACTION"]);

		$table->addColumn("course_group_class_id", "integer");
		$table->addForeignKey("course_group_class_id", "course_group_classes", "id", ["delete"=> "CASCADE", "update"=> "NO_ACTION"]);

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
