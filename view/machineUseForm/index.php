<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 07/09/2017
 * Time: 12:59
 */

loadModules("supplies");
loadModules("machineuseForm");
loadModules("machine/machine");
loadModules("materials");
loadModules("user");
loadModules("lab");

include("static/menu.php");

if(isset($_GET['bills']))
    include('bills.php');
else if(isset($_GET['addUseForm']))
    include('addUseForm.php');
else if(isset($_GET['listUnpaid']))
    include('listUnpaid.php');
else if(isset($_GET['confirmation']) && isset($_GET['useForm']))
    include('confirmation.php');
else include('machineUserForm.php');