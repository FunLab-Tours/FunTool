<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 17/08/2017
 * Time: 16:08
 */

include("static/menu.php");

if(isset($_GET['rightsAndRoles']))
    include("rightsAndRoles/index.php");