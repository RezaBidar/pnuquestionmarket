<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_user extends CI_Migration{

	public function up()
	{
		$prefix = "usr" ;
		$table_name = $this->db->dbprefix("user");
		$this->db->query(
				"CREATE TABLE {$table_name} (
				{$prefix}_id INT(15) NOT NULL AUTO_INCREMENT ,
				{$prefix}_username VARCHAR(50) NOT NULL ,
				{$prefix}_password VARCHAR(255) NOT NULL ,
				{$prefix}_fname VARCHAR(100) NOT NULL ,
				{$prefix}_lname VARCHAR(100) NULL ,
				{$prefix}_level INT(4) DEFAULT 0 ,
				{$prefix}_email VARCHAR(255) NULL ,
				{$prefix}_gender ENUM('male' , 'female') ,
				{$prefix}_tel VARCHAR(20) NULL ,
				{$prefix}_mobile VARCHAR(20) NULL ,
				{$prefix}_avatar VARCHAR(255) NULL ,
				{$prefix}_address TEXT NULL ,
				{$prefix}_created DATETIME NULL ,
				{$prefix}_modified DATETIME NULL ,
				{$prefix}_inserter INT(15) NULL ,
				{$prefix}_modifier INT(15) NULL ,
				CONSTRAINT user_pk PRIMARY KEY ({$prefix}_id) ,
				UNIQUE ({$prefix}_username) ,
				UNIQUE ({$prefix}_email) ,
				CONSTRAINT user_fk_inserter FOREIGN KEY ({$prefix}_inserter) REFERENCES {$table_name} ({$prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT user_fk_modifier FOREIGN KEY ({$prefix}_modifier) REFERENCES {$table_name} ({$prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE 
				) ENGINE=INNODB
				  DEFAULT CHARSET = utf8  
				  DEFAULT COLLATE = utf8_unicode_ci
				  ;"
						);
	}

	public function down()
	{
		$this->dbforge->drop_table('user');
	}

}