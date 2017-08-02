<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 02/08/2017
 * Time: 16:50
 */

$idFamily = intval($_GET['q']);
$result = getSubFamilyList($idFamily);

echo 1;
echo "<select name =\"idFamily\">
			<option value=\"\" selected=\"selected\"><?=".$lang['machineFamily']."\"?></option>";
foreach($result as $row)
    echo "<option value=\"<?=".$row['idFamily']."?>\"><?=".$row['familyLabel']."\"?></option>";

echo "</select>";
echo 2;
?>