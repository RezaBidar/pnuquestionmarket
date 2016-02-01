<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_chart_page extends CI_Migration {

	public function up()
	{
		$prefix = "chartpg" ;
		$table_name = $this->db->dbprefix("chart_page");
		$user_prefix = "usr" ;
		$user_table = $this->db->dbprefix("user") ;
		$major_prefix = "mjr" ;
		$major_table = $this->db->dbprefix("major") ;
		$term_date_prefix = "trm" ;
		$term_date_table = $this->db->dbprefix("term_date") ;
		$this->db->query(
				"CREATE TABLE {$table_name} (
				{$prefix}_id INT(15) NOT NULL AUTO_INCREMENT ,
				{$prefix}_term_date_id INT(15) NULL ,
				{$prefix}_major_id INT(15) NOT NULL ,
				{$prefix}_created DATETIME NOT NULL ,
				{$prefix}_modified DATETIME NOT NULL ,
				{$prefix}_inserter INT(15) NULL ,
				{$prefix}_modifier INT(15) NULL ,
				CONSTRAINT chartpg_pk PRIMARY KEY ({$prefix}_id),
				CONSTRAINT chartpg_fk_inserter FOREIGN KEY ({$prefix}_inserter) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT chartpg_fk_modifier FOREIGN KEY ({$prefix}_modifier) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT chartpg_fk_major FOREIGN KEY ({$prefix}_major_id) REFERENCES {$major_table} ({$major_prefix}_id) ON DELETE RESTRICT ON UPDATE CASCADE,
				CONSTRAINT chartpg_fk_term_date FOREIGN KEY ({$prefix}_term_date_id) REFERENCES {$term_date_table} ({$term_date_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE 
				) ENGINE=INNODB
				DEFAULT CHARSET = utf8
				DEFAULT COLLATE = utf8_unicode_ci
				;"
				);
	}

	public function down()
	{
	$this->dbforge->drop_table('chart_page');
	}
}

