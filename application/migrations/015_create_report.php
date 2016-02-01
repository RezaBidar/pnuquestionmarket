<?php
/**
 * key can be a table and value its ID 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_report extends CI_Migration {

	public function up()
	{
		$prefix = "rprt" ;
		$table_name = $this->db->dbprefix("report");
		$student_prefix = "st" ;
		$student_table = $this->db->dbprefix("student") ;
		$this->db->query(
				"CREATE TABLE {$table_name} (
				{$prefix}_id INT(15) NOT NULL AUTO_INCREMENT ,
				{$prefix}_text TEXT NOT NULL ,
				{$prefix}_key VARCHAR(100) NULL ,
				{$prefix}_value INT(15) NULL ,
				{$prefix}_created DATETIME NOT NULL ,
				{$prefix}_reporter INT(15) NULL ,
				CONSTRAINT rprt_pk PRIMARY KEY ({$prefix}_id),
				CONSTRAINT rprt_fk_reporter FOREIGN KEY ({$prefix}_reporter) REFERENCES {$student_table} ({$student_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE 
				) ENGINE=INNODB
				DEFAULT CHARSET = utf8
				DEFAULT COLLATE = utf8_unicode_ci
				;"
				);
	}

	public function down()
	{
		$this->dbforge->drop_table('report');
	}
}

