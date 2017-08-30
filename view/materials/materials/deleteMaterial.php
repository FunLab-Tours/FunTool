<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 30/08/2017
 * Time: 11:36
 */

deleteMaterial($_GET['deleteMaterial']);
header('Location: index.php?page=materials&material=0');