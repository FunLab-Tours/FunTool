<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 30/08/2017
 * Time: 12:52
 */

loadModules("materials");
include("static/menu.php");


if(isset($_GET['costUnit']))
    include("costUnit/index.php");
else if(isset($_GET['stock']))
    include("costUnit/index.php");
else
    include("materials/index.php");