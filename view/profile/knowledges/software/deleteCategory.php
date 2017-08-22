<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 21/08/2017
 * Time: 15:49
 */

deleteCategory($_GET['deleteCategory']);
header('Location: index.php?page=profile&knowledge=1&categories=1');