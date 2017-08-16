<?php

	function addSubFamily($SubFamilyCode, $SubFamilyLabel, $idFamily)
	{
		global $DB_DB;

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
        return $DB_DB->query('SELECT * FROM SubFamily sf INNER JOIN machineinsubfamily j ON sf.idSubFamily = j.idSubFamily WHERE idMachine ='.$idMachine);
    }
	
	function deleteSubFamily($idDelete)
	{
		global $DB_DB;
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
        global $DB_DB;
		$request = $DB_DB->prepare('UPDATE SubFamily SET  codeSubFamily = :codeSubFamily,
                                                       labelSubFamily = :labelSubFamily,
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