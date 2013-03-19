<?php

class m110819_070824_insert_default extends EDbMigration
{
	public function up()
	{
		$this->insertAuthAssignment();
		$this->insertAuthitem();
		$this->insertRights();
	}

	public function down()
	{
		$this->truncateTable('authassignment');
		$this->truncateTable('authitemchild');
		$this->truncateTable('authitem');
		$this->truncateTable('rights');
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
	private function insertAuthAssignment(){
		$authassignment = array (
		  'itemname' => 'Admin',
		  'userid' => '1',
		  'bizrule' => NULL,
		  'data' => 'N;',
		);
		$this->insert("authassignment", $authassignment);
	}
	private function insertAuthitem(){

		$authitem = array (
		  'name' => 'Rights.AuthItem.Operations',
		  'type' => '0',
		  'description' => 'Admin Auth Operations',
		  'bizrule' => NULL,
		  'data' => 'N;',
		);

		$this->insert("authitem", $authitem);


		$authitem = array (
		  'name' => 'Rights.AuthItem.Tasks',
		  'type' => '0',
		  'description' => 'Admin Auth Tasks',
		  'bizrule' => NULL,
		  'data' => 'N;',
		);

		$this->insert("authitem", $authitem);


		$authitem = array (
		  'name' => 'Rights.AuthItem.Roles',
		  'type' => '0',
		  'description' => 'Admin Auth Roles',
		  'bizrule' => NULL,
		  'data' => 'N;',
		);

		$this->insert("authitem", $authitem);


		$authitem = array (
		  'name' => 'Rights.AuthItem.Permissions',
		  'type' => '0',
		  'description' => 'Assign Permissions',
		  'bizrule' => NULL,
		  'data' => 'N;',
		);

		$this->insert("authitem", $authitem);


		$authitem = array (
		  'name' => 'Rights.Assignment.View',
		  'type' => '0',
		  'description' => 'View Assignment',
		  'bizrule' => NULL,
		  'data' => 'N;',
		);

		$this->insert("authitem", $authitem);


	}

	protected function insertRights() {

	}
}