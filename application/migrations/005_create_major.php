<?php
//maghta 1 -> karshenasi ,, 2 -> arshad ,, 3-> doctora
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_major extends CI_Migration {

	public function up()
	{
		$prefix = "mjr" ;
		$table_name = $this->db->dbprefix("major");
		$user_prefix = "usr" ;
		$user_table = $this->db->dbprefix("user") ;
		$this->db->query(
				"CREATE TABLE {$table_name} (
				{$prefix}_id INT(15) NOT NULL  ,
				{$prefix}_name VARCHAR(100) NULL ,
				{$prefix}_group VARCHAR(100) NULL ,
				{$prefix}_daneshkade VARCHAR(100) NULL ,
				{$prefix}_maghta INT(4) NULL ,
				{$prefix}_first_in INT(5) NULL ,
				{$prefix}_last_in INT(5) NULL ,
				{$prefix}_created DATETIME NOT NULL ,
				{$prefix}_modified DATETIME NOT NULL ,
				{$prefix}_inserter INT(15) NULL ,
				{$prefix}_modifier INT(15) NULL ,
				CONSTRAINT major_pk PRIMARY KEY ({$prefix}_id),
				CONSTRAINT major_fk_inserter FOREIGN KEY ({$prefix}_inserter) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT major_fk_modifier FOREIGN KEY ({$prefix}_modifier) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE 
				) ENGINE=INNODB
				  DEFAULT CHARSET = utf8  
				  DEFAULT COLLATE = utf8_unicode_ci
				  ;"
						);
	}

	public function down()
	{
		$this->dbforge->drop_table('major');
	}
}
	
	