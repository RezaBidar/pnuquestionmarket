<?php
//azmoon type 1 testi 2 tashrihi 3 testi tashrihi
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_book extends CI_Migration {

	public function up()
	{
		$prefix = "lsn" ;
		$table_name = $this->db->dbprefix("lesson");
		$user_prefix = "usr" ;
		$user_table = $this->db->dbprefix("user") ;
		$this->db->query(
				"CREATE TABLE {$table_name} (
				{$prefix}_id INT(15) NOT NULL ,
				{$prefix}_name VARCHAR(100) NULL ,
				{$prefix}_amali_n INT(4) NULL ,
				{$prefix}_nazari_n INT(4) NULL ,
				{$prefix}_amali_h INT(4) NULL ,
				{$prefix}_nazari_h INT(4) NULL ,
				{$prefix}_azmoon_type INT(4) NULL , 
				{$prefix}_created DATETIME NOT NULL ,
				{$prefix}_modified DATETIME NOT NULL ,
				{$prefix}_inserter INT(15) NULL ,
				{$prefix}_modifier INT(15) NULL ,
				CONSTRAINT lesson_pk PRIMARY KEY ({$prefix}_id),
				CONSTRAINT lesson_fk_inserter FOREIGN KEY ({$prefix}_inserter) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT lesson_fk_modifier FOREIGN KEY ({$prefix}_modifier) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE 
				) ENGINE=INNODB
				  DEFAULT CHARSET = utf8  
				  DEFAULT COLLATE = utf8_unicode_ci
				  ;"
						);
	}

	public function down()
	{
		$this->dbforge->drop_table('book');
	}
}
	
	