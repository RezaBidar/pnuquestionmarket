<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_question_page extends CI_Migration {

	public function up()
	{
		$prefix = "qpg" ;
		$table_name = $this->db->dbprefix("question_page");
		$user_prefix = "usr" ;
		$user_table = $this->db->dbprefix("user") ;
		$term_date_prefix = "trm" ;
		$term_date_table = $this->db->dbprefix("term_date") ;
		$this->db->query(
				"CREATE TABLE {$table_name} (
				{$prefix}_id INT(15) NOT NULL AUTO_INCREMENT ,
				{$prefix}_name VARCHAR(100) NOT NULL ,
				{$prefix}_majors TEXT NOT NULL ,
				{$prefix}_seri INT(4) NULL ,
				{$prefix}_test_n INT(4) NULL ,
				{$prefix}_test_time INT(4) NULL ,
				{$prefix}_tashrihi_n INT(4) NULL ,
				{$prefix}_tashrihi_time INT(4) NULL ,
				{$prefix}_term_date_id INT(15) NULL ,
				{$prefix}_inserter INT(15) NULL ,
				{$prefix}_modifier INT(15) NULL ,
				{$prefix}_created DATETIME NOT NULL ,
				{$prefix}_modified DATETIME NOT NULL ,
				CONSTRAINT qpage_pk PRIMARY KEY ({$prefix}_id) ,
				CONSTRAINT qpage_fk_inserter FOREIGN KEY ({$prefix}_inserter) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE,
				CONSTRAINT qpage_fk_modifier FOREIGN KEY ({$prefix}_modifier) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE,
				CONSTRAINT qpage_fk_term_date FOREIGN KEY ({$prefix}_term_date_id) REFERENCES {$term_date_table} ({$term_date_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE 
				) ENGINE=INNODB
				  DEFAULT CHARSET = utf8  
				  DEFAULT COLLATE = utf8_unicode_ci
				  ;"
						);
	}

	public function down()
	{
		$this->dbforge->drop_table('question_page');
	}
}
	
	