<?php

    loadModules("skills");

    if(isset($_GET['unassignSkill']))
        include("unassignSkill.php");
    if(isset($_GET['editAssignment']))
        include("editAssignments.php");
    else include("skillsList.php");

?>