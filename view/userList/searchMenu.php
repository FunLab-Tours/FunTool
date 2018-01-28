<?php

    if(isset($_POST['submitUser']) && $_POST['user'] != "")
        header('Location: index.php?page=userList&result&user='.$_POST['user']);

    if(isset($_POST['submitRoles']) && isset($_POST['roles'])) {
        $roles = "";

        foreach ($_POST['roles'] as $role)
            $roles = $roles . $role . ";";

        header('Location: index.php?page=userList&result&roles='.$roles);
    }
    if(isset($_POST['submitSkills']) && isset($_POST['skills'])) {
        $skills = "";

        foreach ($_POST['skills'] as $skill)
            $skills = $skills . $skill . ";";

        header('Location: index.php?page=userList&result&skills='.$skills);
    }
    if(isset($_POST['submitSoftware']) && isset($_POST['knowledges'])){
        $knowledges = "";

        foreach ($_POST['knowledges'] as $knowledge)
            $knowledges = $knowledges . $knowledge . ";";

        header('Location: index.php?page=userList&result&knowledges='.$knowledges);
    }

?>

<form action="" method="POST">
    <input name="user" placeholder="<?=$lang['userPseudoFirstLastName']?>">
    <input type="submit" name="submitUser" value="<?=$lang['search']?>">
</form>

<form action="" method="POST">
    <select multiple name="roles[]">
        <option disabled value=""><?=$lang['searchRoles']?></option>
        <?php foreach(getRolesList() as $role) { ?>
            <option value="<?=$role['idRole']?>"><?=$role['roleName']?></option>
        <?php } ?>
    </select>
<input type="submit" name="submitRoles" value="<?=$lang['search']?>">
</form>

<form action="" method="POST">
    <select multiple name="skills[]">
        <option disabled value=""><?=$lang['searchSkills']?></option>
        <?php foreach(getSkillsList() as $skill) { ?>
            <option value="<?=$skill['idSkill']?>"><?=$skill['skillName']?></option>
        <?php } ?>
    </select>
    <input type="submit" name="submitSkills" value="<?=$lang['search']?>">
</form>

<form action="" method="POST">
    <select multiple name="knowledges[]">
        <option disabled value=""><?=$lang['searchSoftwares']?></option>
        <?php foreach(listSoftware() as $software) { ?>
            <option value="<?=$software['idSoftware']?>"><?=$software['softwareName']?></option>
        <?php } ?>
    </select>
    <input type="submit" name="submitSoftware" value="<?=$lang['search']?>">
</form>
