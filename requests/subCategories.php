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
loadModules("softwareCategories");

if(isset($_GET['categories']))
{
    //RECUPERATION DE LA LISTE DES CATEGORIES
    /*...*/
    //95;214;568;456
    $split =explode(";" , $_GET['categories'] );
    var_dump($split);
    echo "<select multiple name =\"idSubCategories[]\"> <option value=\"\" disabled selected=\"selected\">".$lang['subCategories']."</option>";
    foreach ($categories as $category){
        foreach (listSubCategories($category['idSoftCat']) as $subCat){
            echo "<option value=\"" . $subCat['idSoftSubcat'] . "\">". $row['SubcatLabel'] . "</option>";
        }
    }
    echo "</select>";
}
else{
    echo "Can't get parameters !";
}