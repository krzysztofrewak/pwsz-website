<?php

use Phinx\Migration\AbstractMigration as Migration;

class FaqsTableMigration extends Migration {

	/**
	 * @return void
	 */
	public function change(): void {
		$table = $this->table("faqs");

		$table->addColumn("question", "text");
		$table->addColumn("answer", "text");

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
