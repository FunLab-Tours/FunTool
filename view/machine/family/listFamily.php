<body>

    <table width='80%' border=0>

        <tr bgcolor='#CCCCCC'>
            <td><?=$lang["family_label"]?></td>
            <td><?=$lang["family_code"]?></td>
            <td><?=$lang["family_nbr_sub"]?></td>
        </tr>

        <a href="?page=machine&add_family=0"><?=$lang["add_family"]?></a>
        <?php
            foreach(getFamilyList() as $row) {
        ?>
                <tr>
                    <td><?=$row['familyLabel']?></td>
                    <td><?=$row['familyCode']?></td>
                    <td><?=countNbrSubFamily($row['idFamily'])?></td>
                    <td>
                        <a href="index.php?page=machine&idEditFamily=<?=$row['idFamily']?>"><?=$lang['edit']?></a>
                        | <a href="index.php?page=machine&idDeleteFamily=<?=$row['idFamily']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a>
                        | <a href="?page=machine&add_subFamily=<?=$row['idFamily']?>"><?=$lang["add_subFamily"]?></a>
                    </td>

                </tr>
                <?php
                foreach(getSubFamilyList($row['idFamily']) as $subrow) {
                    ?>
                    <tr>
                        <td><?=$subrow['labelSubFamily']?></td>
                        <td><?=$subrow['codeSubFamily']?></td>
                        <td><a href="index.php?page=machine&idEditSubFamily=<?=$subrow['idSubFamily']?>"><?=$lang['edit']?></a> | <a href="index.php?page=machine&idDeleteSubFamily=<?=$subrow['idSubFamily']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
                    </tr>
                    <?php
                }
            }
        ?>
    </table>
</body>
