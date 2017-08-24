<?php

    function testSubFamily($id, $sfamilyCode, $sfamilyLabel)
    {
        global $DB_DB;
        if($id == null){
            $result = $DB_DB->query("SELECT * FROM SubFamily WHERE codeSubFamily LIKE '".$sfamilyCode."' OR labelSubFamily LIKE '".$sfamilyLabel."'")->fetchAll();
            if(sizeof($result) != 0) {
                echo "truca";
                return false;
            }
        }
        else{
            $result = $DB_DB->prepare("SELECT * FROM SubFamily WHERE idSubFamily <> '".$id."' AND (codeSubFamily LIKE '".$sfamilyCode."' OR labelSubFamily LIKE '".$sfamilyLabel."')")->fetchAll();
            if(sizeof($result) != 0) {
                echo "truc";
                return false;
            }
        }
        return true;
}

	function addSubFamily($SubFamilyCode, $SubFamilyLabel, $idFamily)
	{
		global $DB_DB;
		if(!testSubFamily(null, $SubFamilyCode, $SubFamilyLabel))
            return false;

        $request = $DB_DB->prepare('INSERT INTO SubFamily(codeSubFamily, labelSubFamily, idFamily) VALUES(:codeSubFamily, :labelSubFamily, :idFamily)');

        try {
            $request->execute(array(
                'codeSubFamily' => $SubFamilyCode,
                'labelSubFamily' => $SubFamilyLabel,
                'idFamily' => $idFamily
            ));
        }
        catch(Exception $e) {
            echo $e;
            exit;
        }
        return true;
	}
	
	function getAllSubFamilyList()
	{
		global $DB_DB;
        return $DB_DB->query('SELECT * FROM SubFamily');
	}

	function getSubFamilyList($idFamily)
    {
        global $DB_DB;
        return $DB_DB->query('SELECT * FROM SubFamily WHERE idFamily ='.$idFamily);
    }

    function getSubFamilyListMachine($idMachine)
    {
        global $DB_DB;
        return $DB_DB->query('SELECT * FROM SubFamily WHERE idSubFamily IN (SELECT idSubFamily FROM machineInSubFamily WHERE idMachine ='.$idMachine.')');
    }
	
	function deleteSubFamily($idDelete)
	{
		global $DB_DB;

		//On supprime tout les liens
        $request = $DB_DB->prepare('DELETE FROM machineInSubFamily WHERE idSubFamily = :idDelete');

        try{
            $request->execute(array(
                'idDelete' => $idDelete
            ));
        }
        catch(Exception $e){
            echo $e;
        }

        //Puis on supprime la sous-famille
		$request = $DB_DB->prepare('DELETE FROM SubFamily WHERE idSubFamily = :idDelete');
		
		try{
			$request->execute(array(
				'idDelete' => $idDelete
				));
		}
		catch(Exception $e){
			echo $e;
		}
	}
	
	function editSubFamily($idSubFamily, $SubFamilyCode, $SubFamilyLabel)
	{
        if(!testSubFamily($idSubFamily, $SubFamilyCode, $SubFamilyLabel))
            return false;

        global $DB_DB;
		$request = $DB_DB->prepare('UPDATE SubFamily SET  codeSubFamily = :codeSubFamily,
                                                       labelSubFamily = :labelSubFamily
                                    WHERE idSubFamily = :idSubFamily');

        try {
            $request->execute(array(
                'codeSubFamily' => $SubFamilyCode,
                'labelSubFamily' => $SubFamilyLabel,
                'idSubFamily' => $idSubFamily
            ));
        }
        catch(Exception $e) {
            echo $e;
        }

        return true;
	}

	function linkSubFamilyWithMachine($idSubFamily, $idMachine)
    {
        global $DB_DB;

        $request = $DB_DB->prepare('INSERT INTO machineinsubfamily(idMachine, idSubFamily) VALUES(:idMachine, :idSubFamily)');

        try {
            $request->execute(array(
                'idSubFamily' => $idSubFamily,
                'idMachine' => $idMachine
            ));
        }
        catch(Exception $e) {
            echo $e;
            exit;
        }
    }
?>