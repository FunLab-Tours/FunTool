<?php

// TODO : transactionStatut -> transactionStatus

/**
 * Create a form to use a machine.
 * @param $idUser : ID of the user who use the machine.
 * @param $idMachine : ID of the used machine.
 * @param $date : date of utilisation.
 * @param $duration : duration of the utilisation.
 * @param $comment : comment about the utilisation.
 * @param $quantityMaterials : quantity of materials used.
 * @param $transactionStatus : status of the transaction.
 * @return array|int|mixed : return the cost of the utilisation and the ID of the form, or an error code if an error occurred.
 */
function createMachineUseForm($idUser, $idMachine, $date, $duration, $comment, $quantityMaterials, $transactionStatus) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO MachineUseForm(	idUser,
														  	idMachine,
														  	dateUseForm,
														  	comment,
														  	entryDate,
														  	transactionStatut,
														  	duration)
                                           			VALUES( :idUser,
                                           					:idMachine,
                                           					:dateUseForm,
                                           					:comment,
                                           					:entryDate,
                                           					:transactionStatus,
                                           					:duration)");

	try {
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
	catch(Exception $e) {
		return $e->getCode();
	}

	$idMachineUseForm = $DB_DB->lastInsertId();

	foreach($quantityMaterials as $quantityMaterial) {
		$request = $DB_DB->prepare("INSERT INTO used (idUseForm, idMat, quantity) VALUES (:idUseForm, :idMat, :quantity)");

		try {
			$request->execute(array(
				'idUseForm' => $idMachineUseForm,
				'idMat' => $quantityMaterial['idMaterial'],
				'quantity' => $quantityMaterial['quantity']
			));
		}
		catch(Exception $e) {
			return $e->getCode();
		}
	}

	return array(
		'cost' => computeCost($idMachineUseForm),
		'id' => $idMachineUseForm
	);
}

/**
 * Change the status of a transaction.
 * @param $idMachineUseForm : ID of the use form to edit.
 * @param $transactionStatus : new status for the transaction.
 * @return int|mixed : error code if an error occurred, else nothing.
 */
function setTransactionStatus($idMachineUseForm, $transactionStatus) {
	global $DB_DB;
	$request = $DB_DB->prepare("UPDATE MachineUseForm SET TransactionStatut = :transactionStatus WHERE idUseForm = :id");

	try {
		$request->execute(array(
			'transactionStatus' => $transactionStatus,
			'id' => $idMachineUseForm
		));
	}
	catch(Exception $e) {
		return $e->getCode();
	}
}

/**
 * Compute the cost of an utilisation.
 * @param $idMachineUseForm : ID of the form to compute.
 * @return float|int : final cost.
 */
function computeCost($idMachineUseForm) {
	$useForm = getMachineUseForm($idMachineUseForm);
	$machine = getMachine($useForm['idMachine']);
	$costUnit = getCostUnit($machine['idCostUnit']);

	$duration_date = date_create($useForm['duration']);
	$duration = intval($duration_date->format('H')) + intval($duration_date->format('i')) / 60;
	$costMachine = $duration * $costUnit['timePackage'] / $costUnit['coeffTime'];

	$costMaterials = 0;

	foreach(listUsedQuantity($idMachineUseForm) as $used) {
		$material = getMaterial($used['idMat']);
		$costUnitMat = getCostUnitMat($material['idMat']);

		$costMaterials += $costUnitMat['costUnit'] * $used['quantity'];
	}

	return $costMachine + $costMaterials;
}

/**
 * Get all information about a machine use form.
 * @param $idMachineUseForm : ID of the use form to check.
 * @return int|mixed : all attributes of a use form or an error code if an error occurred.
 */
function getMachineUseForm($idMachineUseForm) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM MachineUseForm WHERE idUseForm = :idMachineUseForm");

	try {
		$request->execute(array(
			'idMachineUseForm' => $idMachineUseForm
		));
	}
	catch(Exception $e) {
		return $e->getCode();
	}

	return $request->fetchAll()[0];
}

/**
 * List quantity of material used in a use form.
 * @param $idUseForm : ID of the use form to check.
 * @return int|mixed : quantity used or an error code if an error occurred.
 */
function listUsedQuantity($idUseForm) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM used WHERE idUseForm = :idUseForm");

	try {
		$request->execute(array(
			'idUseForm' => $idUseForm
		));
	}
	catch(Exception $e) {
		return $e->getCode();
	}

	return $request->fetchAll();
}

/**
 * List all use form for a specific user.
 * @param $idUser : ID of the user to check.
 * @return int|mixed : list of machine use form or an error code if an error occurred.
 */
function listMachineUseFormByUser($idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM MachineUseForm WHERE idUser = :idUser");

	try {
		$request->execute(array(
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return $e->getCode();
	}

	return $request->fetchAll();
}

/**
 * List all unpaid use form.
 * @param $unpaidForm : status that correspond to unpaid form.
 * @return int|mixed : list unpaid use form or an error code if an error occurred.
 */
function listUnpaidMachineUseForm($unpaidForm) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM MachineUseForm WHERE TransactionStatut LIKE :unpaidForm");

	try {
		$request->execute(array(
			'unpaidForm' => $unpaidForm
		));
	}
	catch(Exception $e) {
		return $e->getCode();
	}

	return $request->fetchAll();
}

/**
 * List all unpaid form for a specific user.
 * @param $idUser : ID of the user to check.
 * @param $unpaidForm : status that correspond to unpaid form.
 * @return int|mixed : list unpaid use form or an error code if an error occurred.
 */
function countUnpaidByUser($idUser, $unpaidForm) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT COUNT(*) FROM machineUseForm WHERE TransactionStatut LIKE :unpaidForm AND idUser = :idUser");

	try {
		$request->execute(array(
			'unpaidForm' => $unpaidForm,
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return $e->getCode();
	}

	return $request->fetch()[0];
}
