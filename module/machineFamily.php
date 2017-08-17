<?php

	function addFamily($familyCode, $familyLabel)
	{
		global $DB_DB;

        $request = $DB_DB->prepare('INSERT INTO Family(familyCode, familyLabel) VALUES(:familyCode, :familyLabel)');

        try {
            $request->execute(array(
                'familyCode' => $familyCode,
                'familyLabel' => $familyLabel
            ));
        }
        catch(Exception $e) {
            echo $e;
            exit;
        }
	}
	
	function getFamilyList() {
		global $DB_DB;
        return $DB_DB->query('SELECT * FROM Family');
	}

    function getFamilyName($idFamily)
    {
        global $DB_DB;
        $request = $DB_DB->prepare('SELECT familyLabel FROM Family WHERE idFamily = :idFamily');

        try {
            $request->execute(array(
                'idFamily' => $idFamily
            ));
        }
        catch(Exception $e) {
            echo $e;
            exit();
        }
        return $request->fetch()[0];
    }
	
	function deleteFamily($idDelete)
	{
		global $DB_DB;
		
		//On remplace par null les familles de machines des machines qui utilisaient cette famille
		$request = $DB_DB->prepare('UPDATE Machine SET idFamily = null
                                    WHERE idFamily = :idFamily');

        try {
            $request->execute(array(
                'idFamily' => $idDelete
            ));
        }
        catch(Exception $e) {
            echo $e;
        }

        //On supprime les sous-familles
        foreach(getSubFamilyList($idDelete) as $subFamily)
            deleteSubFamily($subFamily['idSubFamily']);
		
		//Puis on supprime la famille
		$request = $DB_DB->prepare('DELETE FROM Family WHERE idFamily = :idDelete');
		
		try{
			$request->execute(array(
				'idDelete' => $idDelete
				));
		}
		catch(Exception $e){
			echo $e;
		}
	}
	
	function editFamily($idFamily, $familyCode, $familyLabel)
	{
		global $DB_DB;
		$request = $DB_DB->prepare('UPDATE Family SET  familyCode = :familyCode,
                                                       familyLabel = :familyLabel
                                    WHERE idFamily = :idFamily');

        try {
            $request->execute(array(
                'familyCode' => $familyCode,
                'familyLabel' => $familyLabel,
                'idFamily' => $idFamily
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
	}
	
	function countNbrSubFamily($idFamily)
	{
		global $DB_DB;
		return $DB_DB->query('SELECT COUNT(*) FROM SubFamily
									WHERE idFamily ='.$idFamily)->fetch()[0];
	}
?>