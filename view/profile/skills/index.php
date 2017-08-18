<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/08/2017
 * Time: 10:31
 */

loadModules("skills");

/*SKILLS TYPES*/
if(isset($_GET['editSkillType']))
    include("editSkillType.php");
else if(isset($_GET['deleteSkillType']))
        include("deleteSkillType.php");
/*SKILLS*/
else if(isset($_GET['editSkill']))
    include("editSkill.php");
else if(isset($_GET['deleteSkill']))
        include("deleteSkill.php");
else
    include("skillList.php");