<?php

    function getMaterialStock($idLab, $idMaterial)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT * FROM labSupplies WHERE idLab = :idLab AND idMat = :idMat");
        try{
            $request->execute(array(
               'idLab' => $idLab,
               'idMat' => $idMaterial
            ));
        }
        catch(Exception $e){}

        $result = $request->fetchAll();
        if(empty($result))
            return array('idLab' => $idLab, 'idMat' => $idMaterial, 'quantityInStock' => 0, 'lastRestock' => null);
        return $result[0];
    }

    function updateMaterialsQuantity($idLab, $idMaterial, $nbr)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT COUNT(*) FROM labSupplies WHERE idLab = :idLab AND idMat = :idMat");
        try{
            $request->execute(array(
               'idLab' => $idLab,
               'idMat' => $idMaterial
            ));
        }
        catch(Exception $e){}

        $count = $request->fetch()[0];

        if($count == 0)
        {
            $request = $DB_DB->prepare("INSERT INTO labSupplies (idLab, idMat, quantityInStock, lastRestock)
                                         VALUES (:idLab, :idMat, :nbr, :date)");

            if($nbr < 0)
                $nbr = 0;
            if($nbr > 0)
                $date = date_create("now")->format("Y-m-d H:i:s");
            else
                $date = null;

            try{
                $request->execute(array(
                    'idLab' => $idLab,
                    'idMat' => $idMaterial,
                    'nbr' => $nbr,
                    'date' => $date
                ));
            }
            catch(Exception $e){}
        }
        else
        {
            if($nbr > 0) {
                $request = $DB_DB->prepare("UPDATE labSupplies SET quantityInStock = quantityInStock + :nbr,
                                                          lastRestock = :date
                                                          WHERE idLab = :idLab AND idMat = :idMat");
                try {
                    $request->execute(array(
                        'idLab' => $idLab,
                        'idMat' => $idMaterial,
                        'nbr' => $nbr,
                        'date' => date_create("now")->format("Y-m-d H:i:s")
                    ));
                } catch (Exception $e) {}
            }
            else {
                $request = $DB_DB->prepare("UPDATE labSupplies SET quantityInStock = quantityInStock + :nbr
                                                           WHERE idLab = :idLab AND idMat = :idMat");
                try {
                    $request->execute(array(
                        'idLab' => $idLab,
                        'idMat' => $idMaterial,
                        'nbr' => $nbr,
                    ));
                } catch (Exception $e) {}
            }
        }
    }

?>