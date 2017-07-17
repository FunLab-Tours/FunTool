<?php
    // TODO : correct default value when edditing description.
    // TODO : remove HTML.
    if(isset($_POST['submit']) && !empty($_POST['submit'])) {
       updateLab($_GET['idEdit'], $_POST['labName'], $_POST['labDescription']);
       header('Location: index.php?page=lab');
    }
?>


<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["labName"]?></td>
        <td><?=$lang["labDescription"]?></td>
    </tr>

        <?php
            foreach(listAllLab() as $row) {
                if($row['idLab'] == $_GET['idEdit']) { ?>
                <tr>
                    <form action="" method="post">
                        <td><input type="text" name="labName" value ="<?=$row['labName']?>" /></td>
                        <td><input type="text" name="labDescription" value ="<?=$row['labDescription']?>" /></td>
                        <td><input type="submit" value="submit" name="submit"></td>
                        <a href="index.php?page=lab">Cancel</a>
                    </form>
                </tr>
                <?php
                }
                else { ?>
                    <tr>
                        <td><?=$row['labName']?></td>
                        <td><?=$row['labDescription']?></td>
                    </tr>
                <?php
                }
            }
        ?>

    </table>
</body>
