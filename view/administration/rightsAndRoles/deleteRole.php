<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 17/08/2017
 * Time: 12:17
 */

deleteRole($_GET['deleteRole']);
header('Location: index.php?page=administration&rightsAndRoles&listRoles=1');