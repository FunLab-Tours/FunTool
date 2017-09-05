<?php

    function testSubFamily($id, $sfamilyCode, $sfamilyLabel)
    {
        global $DB_DB;
        if($id == null){
            $request = $DB_DB->prepare("SELECT * FROM SubFamily WHERE codeSubFamily LIKE :sfamilyCode OR labelSubFamily LIKE :sfamilyLabel");

            try{
                $request->execute(array(
                    'sfamilyCode' => $sfamilyCode,
                    'sfamilyLabel' => $sfamilyLabel
            ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;
        }
        else{
            $request = $DB_DB->prepare("SELECT * FROM SubFamily WHERE idSubFamily <> :id AND (codeSubFamily LIKE :sfamilyCode OR labelSubFamily LIKE :sfamilyLabel)");

            try{
                $request->execute(array(
                    'sfamilyCode' => $sfamilyCode,
                    'sfamilyLabel' => $sfamilyLabel,
                    'id' => $id
            ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;
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
        $request = $DB_DB->prepare("SELECT * FROM SubFamily");

        try{
            $request->execute();
        }catch(Exception $e){}

        return $request->fetchAll();
	}

	function getSubFamilyList($idFamily)
    {
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT * FROM SubFamily WHERE idFamily = :id");

        try{
            $request->execute(array(
                'id' => $idFamily
            ));
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function getSubFamilyListMachine($idMachine)
    {
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT * FROM SubFamily WHERE idSubFamily IN (SELECT idSubFamily FROM machineInSubFamily WHERE idMachine = :idMachine)");

        try{
            $request->execute(array(
                'idMachine' => $idMachine
            ));
        }catch(Exception $e){}

        return $request->fetchAll();
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