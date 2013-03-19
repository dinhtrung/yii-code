<?php

class m110819_050103_create_tables extends EDbMigration
{
	public function up()
	{
		$this->createTable("profiles", array(
			"user_id"=>"pk",
			"lastname"=>"varchar(50) NOT NULL",
			"firstname"=>"varchar(50) NOT NULL",
			"birthday"=>"date NOT NULL DEFAULT '0000-00-00'",
		), "");

		$this->createTable("profiles_fields", array(
			"id"=>"pk",
			"varname"=>"varchar(50) NOT NULL",
			"title"=>"varchar(255) NOT NULL",
			"field_type"=>"varchar(50) NOT NULL",
			"field_size"=>"int(3) NOT NULL",
			"field_size_min"=>"int(3) NOT NULL",
			"required"=>"int(1) NOT NULL",
			"match"=>"varchar(255) NOT NULL",
			"range"=>"varchar(255) NOT NULL",
			"error_message"=>"varchar(255) NOT NULL",
			"other_validator"=>"text NOT NULL",
			"default"=>"varchar(255) NOT NULL",
			"widget"=>"varchar(255) NOT NULL",
			"widgetparams"=>"text NOT NULL",
			"position"=>"int(3) NOT NULL",
			"visible"=>"int(1) NOT NULL",
		), "");

		$this->createTable("users", array(
			"id"=>"pk",
			"username"=>"varchar(20) NOT NULL",
			"password"=>"varchar(128) NOT NULL",
			"email"=>"varchar(128) NOT NULL",
			"activkey"=>"varchar(128) NOT NULL",
			"createtime"=>"int(10) NOT NULL",
			"lastvisit"=>"int(10) NOT NULL",
			"superuser"=>"int(1) NOT NULL",
			"status"=>"int(1) NOT NULL",
		), "");
	}

	public function down()
	{
		echo "m110819_050103_create_tables does not support migration down.\n";
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