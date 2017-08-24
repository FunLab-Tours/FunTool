<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 22/08/2017
 * Time: 14:25
 */

include("../include/config.php");
include("../include/lang.php");
include("../include/module.php");
include("../include/db.php");
loadModules("knowledges/softwareCategories");

if(isset($_GET['categories']))
{
    $categories = mb_split(";", $_GET['categories']);
    echo "<select  multiple name =\"idSubCategories[]\" > <option value=\"\" disabled selected=\"selected\">".$lang['subCategories']."</option>";
    foreach ($categories as $category){
        if($category != "")
            foreach (listSubCategories($category) as $subCat){
                echo "<option value=\"" . $subCat['idSoftSubcat'] . "\">". $subCat['SubcatLabel'] . "</option>";
            }
    }
    echo "</select>";
}
else{
    echo "Can't get parameters !";
}