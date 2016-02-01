<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Chart_content extends CI_Migration {

	public function up()
	{
		$prefix = "chartcon" ;
		$table_name = $this->db->dbprefix("chart_content");
		$user_prefix = "usr" ;
		$user_table = $this->db->dbprefix("user") ;
		$lesson_prefix = "lsn" ;
		$lesson_table = $this->db->dbprefix("lesson") ;
		$chart_page_prefix = "chartpg" ;
		$chart_page_table = $this->db->dbprefix("chart_page") ;
		$this->db->query(
				"CREATE TABLE {$table_name} (
				{$prefix}_id INT(15) NOT NULL AUTO_INCREMENT ,
				{$prefix}_type INT(4) NOT NULL ,
				{$prefix}_term INT(4) NOT NULL  ,
				{$prefix}_number_in_term INT(4) NOT NULL ,
				{$prefix}_ekhtiari_nazari_n INT(4) NULL ,
				{$prefix}_lsn_id INT(15)  NULL ,
				{$prefix}_chartpg_id INT(15) NOT NULL ,
				{$prefix}_pishniaz VARCHAR(255) NULL ,
				{$prefix}_created DATETIME NOT NULL ,
				{$prefix}_modified DATETIME NOT NULL ,
				{$prefix}_inserter INT(15) NULL , 
				{$prefix}_modifier INT(15) NULL ,
				CONSTRAINT chartcon_pk PRIMARY KEY ({$prefix}_id),
				CONSTRAINT chartcon_fk_inserter FOREIGN KEY ({$prefix}_inserter) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT chartcon_fk_modifier FOREIGN KEY ({$prefix}_modifier) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT chartcon_fk_lesson FOREIGN KEY ({$prefix}_lsn_id) REFERENCES {$lesson_table} ({$lesson_prefix}_id) ON DELETE RESTRICT ON UPDATE CASCADE ,
				CONSTRAINT chartcon_fk_chartpg FOREIGN KEY ({$prefix}_chartpg_id) REFERENCES {$chart_page_table} ({$chart_page_prefix}_id) ON DELETE RESTRICT ON UPDATE CASCADE
				) ENGINE=INNODB
				DEFAULT CHARSET = utf8
				DEFAULT COLLATE = utf8_unicode_ci
				;"
				);
	}

	public function down()
	{
		$this->dbforge->drop_table('chart_content');
	}
}

