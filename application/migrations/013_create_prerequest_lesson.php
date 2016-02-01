<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Migration_Create_Prerequest_lesson extends CI_Migration {
	public function up() {
		$prefix = "prelsn";
		$table_name = $this->db->dbprefix ( "prerequest_lesson" );
		$user_prefix = "usr";
		$user_table = $this->db->dbprefix('user');
		$chartcon_prefix = "chartcon";
		$chartcon_table = $this->db->dbprefix('chart_content');
		$this->db->query ( 
				"CREATE TABLE {$table_name} (
				{$prefix}_id INT(15) NOT NULL AUTO_INCREMENT ,
				{$prefix}_type INT(4) DEFAULT 0 ,
				{$prefix}_lsn INT(15) NULL ,
				{$prefix}_prelsn INT(15) NULL ,
				{$prefix}_created DATETIME NOT NULL ,
				{$prefix}_modified DATETIME NOT NULL ,
				{$prefix}_inserter INT(15) NOT NULL ,
				{$prefix}_modifier INT(15) NULL ,
				CONSTRAINT prerequest_pk PRIMARY KEY ({$prefix}_id),
				CONSTRAINT prerequest_fk_inserter FOREIGN KEY ({$prefix}_inserter) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE RESTRICT ON UPDATE CASCADE ,
				CONSTRAINT prerequest_fk_modifier FOREIGN KEY ({$prefix}_modifier) REFERENCES {$user_table} ({$user_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT prerequest_fk_chartcon_lsn FOREIGN KEY ({$prefix}_lsn) REFERENCES {$chartcon_table} ({$chartcon_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE ,
				CONSTRAINT prerequest_fk_chartcon_pre FOREIGN KEY ({$prefix}_prelsn) REFERENCES {$chartcon_table} ({$chartcon_prefix}_id) ON DELETE SET NULL ON UPDATE CASCADE
				) ENGINE=INNODB
				DEFAULT CHARSET = utf8
				DEFAULT COLLATE = utf8_unicode_ci
				;" );
	}
	public function down() {
		$this->dbforge->drop_table ( 'prerequest_lesson' );
	}
}

