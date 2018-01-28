<?php

    loadModules("skills");

    // Skills types.
    if(isset($_GET['editSkillType']))
        include("editSkillType.php");
    else if(isset($_GET['deleteSkillType']))
            include("deleteSkillType.php");
    // Skills.
    else if(isset($_GET['editSkill']))
        include("editSkill.php");
    else if(isset($_GET['deleteSkill']))
            include("deleteSkill.php");
    else
        include("skillList.php");

?>