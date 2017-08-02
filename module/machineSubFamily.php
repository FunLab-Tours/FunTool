<?php

	function addSubFamily($SubFamilyCode, $SubFamilyLabel)
	{
		global $DB_DB;

        $request = $DB_DB->prepare('INSERT INTO SubFamily(codeSubFamily, labelSubFamily) VALUES(:codeSubFamily, :labelSubFamily)';

        try {
            $request->execute(array(
                'codeSubFamily' => $SubFamilyCode,
                'labelSubFamily' => $SubFamilyLabel
            ));
        }
        catch(Exception $e) {
            echo $e;
            exit;
        }
	}
	
	function getSubFamilyList()
	{
		global $DB_DB;
        return $DB_DB->query('SELECT * FROM SubFamily');
	}
	
	function delSubFamily($idDelete)
	{
		gloabl $DB_DB;
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
		$request = $DB_DB->prepare('UPDATE SubFamily SET  codeSubFamily = :codeSubFamily,
                                                       labelSubFamily = :labelSubFamily,
                                    WHERE idSubFamily = :idSubFamily');

        try {
            $request->execute(array(
                'codeSubFamily' => $SubFamilyCode,
                'labelSubFamily' => $SubFamilyLabel
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
	}
?>