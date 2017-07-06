<?php
    include('functions.php');

    if(isValidPicture())
        addPicture();
    else if(isset($_POST['submit']))
        echo "Error.";

?>

<form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
    <input type="file" name="picture" size=50 />
    <input type="submit" name="submit" value="Send" />
</form>
