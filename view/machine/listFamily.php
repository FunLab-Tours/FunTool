<body>

    <a href="?page=machine&add_family=0"><?=$lang["add_family"]?></a>
    <table width='80%' border=0>

        <tr bgcolor='#CCCCCC'>
            <td><?=$lang["family_label"]?></td>
            <td><?=$lang["family_code"]?></td>
            <td><?=$lang["family_nbr_sub"]?></td>
        </tr>

        <?php
            foreach(getFamilyList() as $row) {
        ?>
                <tr>
                    <td><?=$row['familyLabel']?></td>
                    <td><?=$row['familyCode']?></td>
                    <td><?countNbrSubFamily($row['idFamily'])?></td>
                    <td><a href="index.php?page=machine&familyManagement=0&idEditFamily=<?=$row['idFamily']?>"><?=$lang['edit']?></a> | <a href="index.php?page=machine&idDeleteFamily=<?=$row['idFamily']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
        <?php
            }
        ?>
    </table>
</body>
