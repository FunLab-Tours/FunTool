<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 24/08/2017
 * Time: 11:31
 */

unassignKnowledge($_GET['deleteKnowledge']);
header('Location: index.php?page=profile&knowledge=1');