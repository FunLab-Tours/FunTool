<?php

	function addCostUnit($timePackage, $coeffTime)
	{
		global $DB_DB;

        $request = $DB_DB->prepare('INSERT INTO CostUnit(timePackage, coeffTime) VALUES(:timePackage, :coeffTime');

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
		global $DB_DB;
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
	
	function editCostUnit($idCostUnit, $timePackage, $coeffTime)
	{
	    global $DB_DB;
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

    function getIdCostUnit($CostUnit, $CostCoeff)
    {
        global $DB_DB;
        //On vérifie si le tarif existe (si oui on récupère son id, sinon on le créé et on récupère son id
        $request = $DB_DB->prepare('SELECT idCostUnit FROM costunit WHERE timePackage LIKE :timePackage AND coeffTime LIKE :coeffTime');
        try {
            $request->execute(array(
                'timePackage' => $CostUnit,
                'coeffTime' => $CostCoeff
            ));
        }
        catch(Exception $e) {
            echo $e;
            exit;
        }
        if($request->rowCount() == 0)
        {
            addCostUnit($CostUnit, $CostCoeff);
            return $DB_DB->lastInsertId();
        }
        else
            return $request->fetch()[0];

    }
?>