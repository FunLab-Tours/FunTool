<?php

    if(isset($_POST['submit']))
        if(editFamily($_GET['idEditFamily'], $_POST['codeFamily'], $_POST['labelFamily']))
            header('Location: index.php?page=machine&familyManagement=0');

?>

<body>
    <table width='80%' border=0>

        <tr bgcolor='#CCCCCC'>
            <td><?=$lang["family_label"]?></td>
            <td><?=$lang["family_code"]?></td>
            <td><?=$lang["family_nbr_sub"]?></td>
        </tr>

        <?php
            foreach(getFamilyList() as $row) {
                if($row['idFamily'] == $_GET['idEditFamily']) {
        ?>
                    <tr>
                        <form method="POST" action="">
                            <td><input type="text" name="labelFamily" value="<?=$row['familyLabel']?>" /></td>
                            <td><input type="text" name="codeFamily" value="<?=$row['familyCode']?>" /></td>
							<td><?countNbrSubFamily($row['idFamily'])?></td>
							<td><input type="submit" value="<?=$lang["submit"]?>" name="submit">
                        </form>
                    </tr>
        <?php
                }
                else {
        ?>
					<tr>
						<td><?=$row['familyLabel']?></td>
						<td><?=$row['familyCode']?></td>
						<td><?=countNbrSubFamily($row['idFamily'])?></td>
						<td><a href="index.php?page=machine&idEditFamily=<?=$row['idFamily']?>"><?=$lang['edit']?></a> | <a href="index.php?page=machine&idDeleteFamily=<?=$row['idFamily']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
					</tr>
        <?php
                }
            }
        ?>

    </table>
	<a href="?page=machine&add_family=0"><?=$lang["add_family"]?></a>
</body>
