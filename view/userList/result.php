<?php

    if(isset($_GET['user']))
        $result = searchForUser($_GET['user']);
    else if(isset($_GET['roles']))
        $result = searchForRoles(mb_split(";", $_GET['roles']));
    else if(isset($_GET['skills']))
        $result = searchForSkills(mb_split(";", $_GET['skills']));
    else if(isset($_GET['knowledges']))
        $result = searchForKnowledges(mb_split(";", $_GET['knowledges']));

    if(isset($result)) { ?>
    <table width='80%' border=0>
        <tr bgcolor='#CCCCCC'>
            <td><?=$lang['login']?></td>
    <td><?=$lang['picture']?></td>
    <td><?=$lang['firstName']?></td>
    <td><?=$lang['name']?></td>
    <td><?=$lang['email']?></td>
    <td><?=$lang['roles']?></td>
    <td><?=$lang['skills']?></td>
    <td><?=$lang['knowledges']?></td>
    </tr>
    <?php foreach ($result as $user) { ?>
            <tr>
                <td><?= $user['login'] ?></td>
                <?php if (getPicture($user['idPicture']) != null && getPicture($user['idPicture'])['picture'] != "") { ?>
                    <td><img src="<?= getPicture($user['idPicture'])['picture'] ?>" height="42" width="42"
                             alt="<?= getPicture($user['idPicture'])['pictureDescription'] ?>"</td>
                <?php } else { ?>
                    <td></td>
                <?php } ?>
                <td><?= $user['firstName'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <?php foreach (getUserRoles($user['idUser']) as $role) {
                        echo $role['roleName'] . " ; ";
                    } ?>
                </td>
                <td>
                    <?php foreach (getSkillsListUser($user['idUser']) as $skill) {
                        echo $skill['skillName'] . " ; ";
                    } ?>
                </td>
                <td>
                    <?php foreach (listKnowledges($user['idUser']) as $knowledge) {
                        echo getSoftWare($knowledge['idSoftware'])['softwareName'] . " ; ";
                    } ?>
                </td>
                <td>
                    <?php if ($user['idUser'] != $_COOKIE['id']) { ?>
                        <a href="index.php?page=mailBox&send=<?= $user['idUser'] ?>"><?= $lang['contact'] ?></a> |
                        <a href="index.php?page=userList&details=<?= $user['idUser'] ?>"><?= $lang['moreDetails'] ?></a>
                    <?php } else { ?>
                        <a href="index.php?page=profile"><?= $lang['moreDetails'] ?></a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>