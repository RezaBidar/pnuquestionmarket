<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* type == testi  - tashrihi
**/

class Migration_create_question extends CI_Migration {

	public function up()
	{
		$prefix = "qst" ;
		$table_name = $this->db->dbprefix("question");
		$user_prefix = "usr" ;
		$user_table = $this->db->dbprefix("user") ;
		$question_page_prefix = "qpg" ;
		$question_page_table = $this->db->dbprefix("question_page") ;
		$this->db->query(
				"CREATE TABLE {$table_name} (
				{$prefix}_id INT(15) NOT NULL AUTO_INCREMENT ,
				{$prefix}_text TEXT NULL ,
				{$prefix}_number_in_page INT(4) DEFAULT 0 ,
				{$prefix}_a TEXT NULL ,
				{$prefix}_b TEXT NULL ,
				{$prefix}_c TEXT NULL ,
				{$prefix}_d TEXT NULL ,
				{$prefix}_answer_text TEXT NULL ,
				{$prefix}_answer INT(4) NULL ,
				{$prefix}_type INT(4) NULL ,
				{$prefix}_qpage_id INT(15) NULL ,
				{$prefix}_inserter INT(15) NULL ,
				{$prefix}_modifier INT(15) NULL ,
				{$prefix}_created DATETIME NOT NULL ,
				{$prefix}_modified DATETIME NOT NULL ,
				CONSTRAINT qpage_pk PRIMARY KEY ({$prefix}_id) ,
				CONSTRAINT qpage_fk_qpage FOREIGN KEY ({$prefix}_qpage_id) REFERENCES {$question_page_table} ({$question_page_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT qpage_fk_user_inserter FOREIGN KEY ({$prefix}_inserter) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT qpage_fk_user_modifier FOREIGN KEY ({$prefix}_modifier) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE 
				) ENGINE=INNODB
				  DEFAULT CHARSET = utf8  
				  DEFAULT COLLATE = utf8_unicode_ci
				  ;"
						);
	}

	public function down()
	{
		$this->dbforge->drop_table('question');
	}
}
	
	
