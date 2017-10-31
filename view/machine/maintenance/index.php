<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 21/09/2017
 * Time: 15:30
 */

include("static/maintenanceMenu.php");

if(isset($_GET['historical']))
    include("historical.php");
else include("maintenance.php");
