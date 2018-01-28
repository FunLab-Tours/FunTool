<?php

    unassignSkill($_COOKIE['id'], $_GET['unassignSkill']);
    header('Location: index.php?page=profile&usersSkills=1');

?>