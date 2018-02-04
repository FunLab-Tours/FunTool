<html>

<?php

    if(isset($_POST['submit'])) {
		$isValidSignOnReturn = isValidMachineSubmit();

		if($isValidSignOnReturn && $isValidSignOnReturn > 0) {
            if(!isset($_POST['idSubFamily']))
                $subFamily = null;
            else
                $subFamily = $_POST['idSubFamily'];
                $id = addMachine($_POST['codeMachine'],
                    $_POST['shortLabel'],
                    $_POST['longLabel'],
                    $_POST['serialNumber'],
                    $_POST['manufacturer'],
                    $_POST['comment'],
                    $_POST['docLink1'],
                    $_POST['docLink2'],
                    $_POST['idFamily'],
                    $subFamily,
                    $_POST['cost'],
                    $_POST['costCoeff'],
                    $_POST['idLab']);

            assignMaterialsToMachine($id, $_POST['idMaterials']);
            header('Location: index.php?page=machine&chooseImage='.$id);
        }
		else
			echo $error[$isValidSignOnReturn];
	}

?>

<form action="" method="post">
    <input type="text" placeholder="<?=$lang['codeMachineInput']?>" name="codeMachine" />
    <input type="text" placeholder="<?=$lang['shortLabelInput']?>" name="shortLabel" />
    <input type="text" placeholder="<?=$lang['longLabelInput']?>" name="longLabel" />
    <input type="text" placeholder="<?=$lang['serialNumberInput']?>" name="serialNumber" />
    <input type="text" placeholder="<?=$lang['manufacturerInput']?>" name="manufacturer" />
    <input type="text" placeholder="<?=$lang['commentInput']?>" name="comment" />
    <input type="text" placeholder="<?=$lang['docLink1Input']?>" name="docLink1" />
    <input type="text" placeholder="<?=$lang['docLink2Input']?>" name="docLink2" />
    <select name ="idFamily" onchange="updateSubList(this.value)">
        <option value="" selected="selected"><?=$lang['machineFamily']?></option>
        <?php foreach(getFamilyList() as $row){?>
            <option value="<?=$row['idFamily']?>"><?=$row['familyLabel']?></option>
        <?php } ?>
    </select>
    <div id="idSubFamily" name="idSubFamily"></div>
    <input type="number" min="0" placeholder="<?=$lang['cost']?>" name="cost" />
    x
    <input type="number" min="0" step="0.1" placeholder="<?=$lang['costCoeff']?>" name="costCoeff" />
    <select name ="idLab"">
        <option value="" selected="selected"><?=$lang['funLab']?></option>
        <?php
        foreach(listAllLab() as $row){?>
            <option value="<?=$row['idLab']?>"><?=$row['labName']?></option>
        <?php } ?>
    </select>
    <select multiple name ="idMaterials"">
        <option value="" selected="selected"><?=$lang['machineMaterials']?></option>
        <?php foreach(listMaterials() as $row){?>
            <option value="<?=$row['idMat']?>"><?=$row['labelMat']?></option>
        <?php } ?>
    </select>
    <input type="submit" value="<?=$lang["submit"]?>" name="submit">
</form>

<script>
    function updateSubList(str) {
        if(str == "") {
            document.getElementById("idSubFamily").innerHTML = "";
            return;
        }
        else
        {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("idSubFamily").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "requests/subFamily.php?q="+str,false);
            xmlhttp.send(null);
        }
    }
</script>
