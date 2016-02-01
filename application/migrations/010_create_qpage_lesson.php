<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_qpage_lesson extends CI_Migration {

	public function up()
	{
		$prefix = "qpglsn" ;
		$table_name = $this->db->dbprefix("qpage_lesson");
		$user_prefix = "usr" ;
		$user_table = $this->db->dbprefix("user") ;
		$qpage_prefix = "qpg" ;
		$qpage_table = $this->db->dbprefix("question_page") ;
		$lesson_prefix = "lsn" ;
		$lesson_table = $this->db->dbprefix("lesson") ;
		$this->db->query(
				"CREATE TABLE {$table_name} (
				{$prefix}_id INT(15) NOT NULL AUTO_INCREMENT ,
				{$prefix}_created DATETIME NOT NULL ,
				{$prefix}_modified DATETIME NOT NULL ,
				{$prefix}_qpage_id INT(15) NOT NULL ,
				{$prefix}_lesson_id INT(15) NULL ,
				{$prefix}_inserter INT(15) NULL ,
				{$prefix}_modifier INT(15) NULL ,
				CONSTRAINT qpage_major_pk PRIMARY KEY ({$prefix}_id),
				CONSTRAINT qpage_major_fk_qpage FOREIGN KEY ({$prefix}_qpage_id) REFERENCES {$qpage_table} ({$qpage_prefix}_id) ON DELETE CASCADE ON UPDATE CASCADE ,
				CONSTRAINT qpage_major_fk_lesson FOREIGN KEY ({$prefix}_lesson_id) REFERENCES {$lesson_table} ({$lesson_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT qpage_major_fk_inserter FOREIGN KEY ({$prefix}_inserter) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT qpage_major_fk_modifier FOREIGN KEY ({$prefix}_modifier) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE 
				) ENGINE=INNODB
				  DEFAULT CHARSET = utf8  
				  DEFAULT COLLATE = utf8_unicode_ci
				  ;"
						);
	}

	public function down()
	{
		$this->dbforge->drop_table('qpage_lesson');
	}
}
	
	