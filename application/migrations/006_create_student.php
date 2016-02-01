<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_student extends CI_Migration {

	public function up()
	{
		$prefix = "st" ;
		$table_name = $this->db->dbprefix("student");
		$major_prefix = "mjr" ;
		$major_table = $this->db->dbprefix("major") ;
		$university_prefix = "uni" ;
		$university_table = $this->db->dbprefix("university") ;
		$this->db->query(
				"CREATE TABLE {$table_name} (
				{$prefix}_id INT(15) NOT NULL AUTO_INCREMENT ,
				{$prefix}_name VARCHAR(100) NULL ,
				{$prefix}_android_ver INT(4) NULL ,
				{$prefix}_api_code VARCHAR(255) NOT NULL ,
				{$prefix}_ip VARCHAR(15) NOT NULL ,
				{$prefix}_major_id INT(15) NULL ,
				{$prefix}_uni_id INT(15) NULL ,
				{$prefix}_created DATETIME NOT NULL ,
				{$prefix}_modified DATETIME NOT NULL ,
				CONSTRAINT student_pk PRIMARY KEY ({$prefix}_id) ,
				CONSTRAINT student_fk_major FOREIGN KEY ({$prefix}_major_id) REFERENCES {$major_table} ({$major_prefix}_id) ON DELETE RESTRICT ON UPDATE CASCADE ,
				CONSTRAINT student_fk_uni FOREIGN KEY ({$prefix}_uni_id) REFERENCES {$university_table} ({$university_prefix}_id) ON DELETE RESTRICT ON UPDATE CASCADE 
				) ENGINE=INNODB
				  DEFAULT CHARSET = utf8  
				  DEFAULT COLLATE = utf8_unicode_ci
				  ;"
						);
	}

	public function down()
	{
		$this->dbforge->drop_table('student');
	}
}
	
	