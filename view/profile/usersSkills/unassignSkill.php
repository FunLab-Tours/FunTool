<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/08/2017
 * Time: 15:39
 */

unassignSkill($_COOKIE['id'], $_GET['unassignSkill']);
header('Location: index.php?page=profile&usersSkills=1');