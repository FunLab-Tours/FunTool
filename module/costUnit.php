<?php

	function addCostUnit($timePackage, $coeffTime)
	{
		global $DB_DB;

        $request = $DB_DB->prepare('INSERT INTO CostUnit(timePackage, coeffTime) VALUES(:timePackage, :coeffTime)';

        try {
            $request->execute(array(
                'timePackage' => $timePackage,
                'coeffTime' => $coeffTime
            ));
        }
        catch(Exception $e) {
            echo $e;
            exit;
        }
	}
	
	function getCostUnitList()
	{
        global $DB_DB;
        return $DB_DB->query('SELECT * FROM costUnit');
    }
	
	function delCostUnit($idDelete)
	{
		gloabl $DB_DB;
		$request = $DB_DB->prepare('DELETE FROM costUnit WHERE idCostUnit = :idCostUnit');
		
		try{
			$request->execute(array(
				'idCostUnit' => $idDelete
				));
		}
		catch(Exception $e){
			echo $e;
		}
	}
	
	function editCostUnit($idCostUnit, $timepackage, $coeffTime)
	{
		$request = $DB_DB->prepare('UPDATE costUnit SET  timePackage = :timePackage,
                                                        coeffTime = :coeffTime,
                                    WHERE idCostUnit = :idCostUnit');

        try {
            $request->execute(array(
                'timePackage' => $timePackage,
                'coeffTime' => $coeffTime
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
	}

?>