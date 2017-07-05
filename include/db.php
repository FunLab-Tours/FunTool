<?php
	include('config.php');

	$DB_Open = false;

	function ConnectionDB(){
		global $DB_Open, $DB_User, $DB_Password, $DB_Host, $DB_Database, $DB_DB;

		if($DB_Open == false){	
			try{
				$DB_DB = new PDO("mysql:host=$DB_Host;dbname=$DB_Database", $DB_User, $DB_Password);
				$DB_Open = true;
			}
			catch(Exception $e){
				echo $e;
				exit;
			}
		}	
	}

	ConnectionDB();

?>
