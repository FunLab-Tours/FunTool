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
	
	function getFamilyList()
	{
		global $DB_DB;
        return $DB_DB->query('SELECT * FROM family');
	}
	
	function delFamily($idDelete)
	{
		global $DB_DB;
		$request = $DB_DB->prepare('DELETE FROM family WHERE idFamily = :idDelete');
		
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
		$request = $DB_DB->prepare('UPDATE Family SET  familyCode = :familyCode,
                                                       familyLabel = :familyLabel,
                                    WHERE idFamily = :idFamily');

        try {
            $request->execute(array(
                'familyCode' => $familyCode,
                'familyLabel' => $familyLabel
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
	}
	
	function countNbrSubFamily($idFamily)
	{
		$request = $DB_DB->prepare('SELECT COUNT(*) FROM SubFamily
									WHERE idFamily = :idFamily');

        try {
            $request->execute(array(
                'idFamily' => $idFamily,
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
	}
?>