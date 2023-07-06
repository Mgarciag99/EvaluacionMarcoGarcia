<?php 
class Database{


    public static function connect(){
		$db = new mysqli('localhost', 'root', '', 'tests_evaluation');
		$db->query("SET NAMES 'utf8'");
		return $db;
	}


}



?>