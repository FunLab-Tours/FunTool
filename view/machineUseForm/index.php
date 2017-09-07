<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 07/09/2017
 * Time: 12:59
 */

loadModules("supplies");
loadModules("machineuseForm");

if(isset($_GET['bills']))
    include('bills.php');
else include('machineUserForm.php');