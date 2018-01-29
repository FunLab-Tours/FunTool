<?php

    function createMachineUseForm($idUser, $idMachine, $date, $duration, $comment, $quantityMaterials,
                                  $transactionStatus) {
        global $DB_DB;
        //var_dump(array($idUser, $idMachine, date_create($date)->format("Y-m-d H:i:s"), $duration, $comment, $quantityMaterials, $transactionStatus, date_create("now")->format("Y-m-d H:i:s")));

        $request = $DB_DB->prepare("INSERT INTO MachineUseForm (idUser, idMachine, dateUseForm, comment, entryDate, transactionStatut, duration)
                                           VALUES (:idUser, :idMachine, :dateUseForm, :comment, :entryDate, :transactionStatus, :duration)");

        try{
            $request->execute(array(
                'idUser' => $idUser,
                'idMachine' => $idMachine,
                'dateUseForm' => date_create($date)->format("Y-m-d H:i:s"),
                'comment' => $comment,
                'entryDate' => date_create("now")->format("Y-m-d H:i:s"),
                'transactionStatus' => $transactionStatus,
                'duration' => $duration
            ));
        }
        catch(Exception $e){}

        $idMachineUseForm = $DB_DB->lastInsertId();

        foreach ($quantityMaterials as $quantityMaterial){
            $request = $DB_DB->prepare("INSERT INTO used (idUseForm, idMat, quantity) VALUES (:idUseForm, :idMat, :quantity)");

            try{
                $request->execute(array(
                   'idUseForm' => $idMachineUseForm,
                   'idMat' => $quantityMaterial['idMaterial'],
                   'quantity' => $quantityMaterial['quantity']
                ));
            }catch(Exception $e){}
        }

        return array('cost' => calculCost($idMachineUseForm), 'id' => $idMachineUseForm);
    }

    function setTransactionStatus($idMachineUseForm, $transactionStatus)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("UPDATE MachineUseForm SET TransactionStatut = :transactionStatus 
                                    WHERE idUseForm = :id");

        try{
            $request->execute(array(
                'transactionStatus' => $transactionStatus,
                'id' => $idMachineUseForm
            ));
        }catch(Exception $e){}
    }

    function calculCost($idMachineUseForm)
    {
        $useForm = getMachineUseForm($idMachineUseForm);
        $machine = getMachine($useForm['idMachine']);
        $costUnit = getCostUnit($machine['idCostUnit']);

        $duration_date = date_create($useForm['duration']);
        $duration = intval($duration_date->format('H')) + intval($duration_date->format('i')) / 60;
        $costMachine = $duration * $costUnit['timePackage'] / $costUnit['coeffTime'];

        $costMaterials = 0;
        foreach (listUsedQuantity($idMachineUseForm) as $used) {
            $material = getMaterial($used['idMat']);
            $costUnitMat = getCostUnitMat($material['idMat']);

            $costMaterials += $costUnitMat['costUnit'] * $used['quantity'];
        }

        return $costMachine + $costMaterials;
    }

    function getMachineUseForm($idMachineUseForm)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT * FROM MachineUseForm WHERE idUseForm = :id");

        try{
            $request->execute(array(
               'id' => $idMachineUseForm
            ));
        }catch(Exception $e){}

        return $request->fetchAll()[0];
    }

    function listUsedQuantity($idUseForm)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT * FROM used WHERE idUseForm = :id");

        try{
            $request->execute(array(
                'id' => $idUseForm
            ));
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function listMachineUseFormUser($idUser)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT * FROM MachineUseForm WHERE idUser = :idUser");

        try{
            $request->execute(array(
               'idUser' => $idUser
            ));
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function listUnpaidMachineUseForm($unpaidForm)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT * FROM MachineUseForm WHERE TransactionStatut LIKE :unpaidForm");

        try{
            $request->execute(array(
               'unpaidForm' => $unpaidForm
            ));
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function countUnpaidUser($idUser, $unpaidForm)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT COUNT(*) FROM machineUseForm WHERE TransactionStatut LIKE :unpaidForm AND idUser = :idUser");

        try{
            $request->execute(array(
                'unpaidForm' => $unpaidForm,
                'idUser' => $idUser

            ));
        }catch(Exception $e){}

        return $request->fetch()[0];
    }

?>