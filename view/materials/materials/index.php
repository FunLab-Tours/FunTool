<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 30/08/2017
 * Time: 11:34
 */

loadModules("materials");

if(isset($_GET['editMaterial']))
    include("editMaterial.php");
else if(isset($_GET['deleteMaterial']))
    include("deleteMaterial.php");
else include("listMaterials.php");