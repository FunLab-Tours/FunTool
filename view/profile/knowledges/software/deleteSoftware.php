<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 21/08/2017
 * Time: 15:45
 */

deleteSoftware($_GET['deleteSoftware']);
header('Location: index.php?page=profile&knowledge=1&softwares=1');