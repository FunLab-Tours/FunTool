<?php
    if(isset($_POST['submit']) && !empty($_POST['submit'])) {
       updateProject($_GET['idEdit'], $_POST['title'], $_POST['wiki'], $_POST['dateProject']);
       //header('Location: index.php?page=project');
       echo $_GET['idEdit'];
       echo $_POST['title'];
    }
?>

<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["projectTitle"]?></td>
        <td><?=$lang["projectWiki"]?></td>
        <td><?=$lang["dateProject"]?></td>
        <td><?=$lang["pictureProject"]?></td>
    </tr>

        <?php
            foreach (selectProject($_GET['idEdit']) as $row) {?>

                <tr>
                    <form action="" method="post">
                        <td><input type="text" name="title" value ="<?=$row['title']?>" /></td>
                        <td><input type="text" name="wiki" value ="<?=$row['wiki']?>" /></td>
                        <td><input type="date" name="dateProject" value ="<?=date("Y-m-d", strtotime($row['dateProject']))?>"/></td>
                        <td><img src="<?=selectProjectPicture($_GET['idEdit'])?>" alt="<?=$row['title']?>">
                        <br><br>
                        <a href="index.php?page=project&idDelete=<?=$row[idProject]?>" onClick=\"return confirm('Are you sure you want to delete?')"><?=$lang["delete"]?></a></td>
                        <td><input type="submit" value=<?=$lang["submit"]?> name="submit"><a href="index.php?page=project"><?=$lang["cancel"]?></a></td>
                    </form>
                </tr>
                <?php
            }
        ?>
    </table>
</body>