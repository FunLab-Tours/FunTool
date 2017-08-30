<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 30/08/2017
 * Time: 12:52
 */

include("static/menu.php");

if(isset($_GET['material']))
    include("materials/index.php");
else if(isset($_GET['costUnit']))
    include("costUnit/index.php");