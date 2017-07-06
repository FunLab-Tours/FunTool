<?php
    include('functions.php');

    if(isset($_POST['picture']))
        deletePicture();
?>

<?php
    $labels = getPictureList();
    while($buffer = $labels->fetch()) {
        ?>
        <form method="POST" action="">
            <img src="uploaded/<?=$buffer['picture']?>" alt="<?=$buffer['pictureDescription']?>" style="width:200px; height:200px;" />
            <input type="hidden" name="picture" value="<?=$buffer['picture']?>" />
            <input type="submit" value="Delete" />
        </form><?php
    }
?>
