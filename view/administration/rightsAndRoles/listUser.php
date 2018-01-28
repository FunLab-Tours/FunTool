<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang['login']?></td>
        <td><?=$lang['firstName']." ".$lang['name']?></td>
        <td><?=$lang['roles']?></td>
        <td><?=$lang['rights']?></td>
    </tr>
    <?php foreach(getUserList() as $row){ ?>
        <tr>
            <td><?=$row['login']?></td>
            <td><?=$row['firstName']." ".$row['name']?></td>
            <td>
                <?php foreach(getUserRoles($row['idUser']) as $role){ ?>
                    <?=$role['roleName']?> ;
                <?php } ?>
            </td>
            <td>
                <?php getRightsListWithRoles(getUserRoles($row['idUser']))?>
            </td>
            <td><a href="index.php?page=administration&rightsAndRoles&editUser=<?=$row['idUser']?>"><?=$lang['edit']?></a></td>
        </tr>
    <?php } ?>
</table>
