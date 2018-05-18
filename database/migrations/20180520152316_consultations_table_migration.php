<?php

use Phinx\Migration\AbstractMigration as Migration;

class ConsultationsTableMigration extends Migration {

	/**
	 * @return void
	 */
	public function change(): void {
		$table = $this->table("consultations");

		$table->addColumn("datetime", "timestamp");
		$table->addColumn("place", "string", ["default" => ""]);

		$table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"]);
		$table->addColumn("updated_at", "timestamp", ["default" => "CURRENT_TIMESTAMP", "update" => "CURRENT_TIMESTAMP"]);

		$table->create();
	}

}
