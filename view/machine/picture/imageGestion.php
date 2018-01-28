<?php
    if(isset($_POST['submit_choose'])) {
        assignPicture( $_GET['chooseImage'], $_POST['idImage']);
        header('Location: index.php?page=machine');
    }
    else if(isset($_POST['submit_create']) && $_POST['url'] != null && $_POST['description'] != null) {
        addPictureAndAssign($_GET['chooseImage'], $_POST['url'], $_POST['description']);
        header('Location: index.php?page=machine');
    }

?>

<body>
    <?=$lang['choose_image']?>

    <form action="" method="post">
        <?php
        $count = 0;
        foreach(getListPictureMachine() as $row){?>
            <br><?=$row['pictureDescription']?>
            <input type="radio" name="idImage" value="<?=$row['idPicture']?>"><?=$row['picture']?><br>
            <?php $count++;
        }
        if($count != 0){?>
            <input type="submit" value="<?=$lang["submit"]?>" name="submit_choose">
        <?php }?>
    </form>
    <form action="" method="post">
        <input type="text" placeholder="<?=$lang['url_image']?>" name="url" />
        <input type="text" placeholder="<?=$lang['description_image']?>" name="description" />
        <input type="submit" value="<?=$lang["new_image"]?>" name="submit_create">
    </form>
</body>