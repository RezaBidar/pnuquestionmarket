<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_session extends CI_Migration{

	

	public function up(){
		$table_name = $this->db->dbprefix('sessions') ;
		$query = 
			'CREATE TABLE IF NOT EXISTS `' . $table_name . '` (
			        `id` varchar(40) NOT NULL,
			        `ip_address` varchar(45) NOT NULL,
			        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
			        `data` blob NOT NULL,
			        PRIMARY KEY (id),
			        KEY `ci_sessions_timestamp` (`timestamp`)
			); '
		;
		$this->db->query($query);
		

	}

	public function down(){
		$table_name = $this->db->dbprefix('sessions') ;
		$query = 'DROP TABLE IF EXISTS `' . $table_name . '` ' ;
		$this->db->query($query) ;
	}
}