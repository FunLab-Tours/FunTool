<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/08/2017
 * Time: 14:56
 */

loadModules("skills");

if(isset($_GET['unassignSkill']))
    include("unassignSkill.php");
if(isset($_GET['editAssignment']))
    include("editAssignments.php");
else include("skillsList.php");