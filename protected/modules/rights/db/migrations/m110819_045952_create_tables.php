<?php

class m110819_045952_create_tables extends EDbMigration
{
	public function up()
	{
		$this->createTable("authassignment", array(
			"itemname"=>"pk",
			"userid"=>"pk",
			"bizrule"=>"text",
			"data"=>"text",
		), "");

		$this->createTable("authitem", array(
			"name"=>"pk",
			"type"=>"integer NOT NULL",
			"description"=>"text",
			"bizrule"=>"text",
			"data"=>"text",
		), "");

		$this->createTable("authitemchild", array(
			"parent"=>"pk",
			"child"=>"pk",
		), "");
		$this->createTable("rights", array(
			"itemname"=>"pk",
			"type"=>"integer NOT NULL",
			"weight"=>"integer NOT NULL",
		), "");
	}

	public function down()
	{
		echo "m110819_045952_create_tables does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}