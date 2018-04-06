<?php

use Phinx\Migration\AbstractMigration as Migration;

class CourseTopicFilesTableMigration extends Migration {

	public function change() {
		$table = $this->table("course_topic_files");

		$table->addColumn("url", "string");
		$table->addColumn("icon", "string");

		$table->addColumn("course_topic_id", "integer");
		$table->addForeignKey("course_topic_id", "course_topics", "id", ["delete" => "CASCADE", "update" => "NO_ACTION"]);

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
