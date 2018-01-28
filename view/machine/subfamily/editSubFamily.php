<?php

    if(isset($_POST['submit']))
        if(editSubFamily($_GET['idEditSubFamily'], $_POST['codeSubFamily'], $_POST['labelSubFamily']))
            header('Location: index.php?page=machine&familyManagement=0');

?>

<body>
    <table width='80%' border=0>

        <tr bgcolor='#CCCCCC'>
            <td><?=$lang["subFamily_label"]?></td>
            <td><?=$lang["subFamily_code"]?></td>
        </tr>

        <?php
            foreach(getAllSubFamilyList() as $row) {
                if($row['idSubFamily'] == $_GET['idEditSubFamily']) {
        ?>
                    <tr>
                        <form method="POST" action="">
                            <td><input type="text" name="labelSubFamily" value="<?=$row['labelSubFamily']?>" /></td>
                            <td><input type="text" name="codeSubFamily" value="<?=$row['codeSubFamily']?>" /></td>
							<td><input type="submit" value="<?=$lang["submit"]?>" name="submit">
                        </form>
                    </tr>
        <?php
                }
                else {
        ?>
					<tr>
						<td><?=$row['labelSubFamily']?></td>
						<td><?=$row['codeSubFamily']?></td>=
						<td><a href="index.php?page=machine&idEditSubFamily=<?=$row['idSubFamily']?>"><?=$lang['edit']?></a> | <a href="index.php?page=machine&idDeleteSubFamily=<?=$row['idSubFamily']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
					</tr>
        <?php
                }
            }
        ?>

    </table>
</body>
