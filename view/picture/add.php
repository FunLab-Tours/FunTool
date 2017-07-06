<?php
    include('functions.php');

    if(isValidPicture())
        addPicture();
    else if(strlen(http_build_query($_POST)) != 0)
        echo "Error.";

?>

<form method="POST" action="add.php" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
    <input type="file" name="picture" size=50 />
    <input type="submit" value="Send" />
</form>
