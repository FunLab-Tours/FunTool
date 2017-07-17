<?php
    // TODO : use parameters.
    // TODO : finish it.

    function isValidPicture() {
        $maxwidth = 60000;
        $maxheight = 60000;

        if(!isset($_FILES['picture']))
            return false;

        if ($_FILES['picture']['error'] > 0)
            return false;

        $image_sizes = getimagesize($_FILES['picture']['tmp_name']);
        if($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
            return false;

        $exts = array('jpg', 'jpeg', 'gif', 'png');
        $ext_upload = strtolower(substr(strrchr($_FILES['picture']['name'], '.'),1));
        if(in_array($ext_upload, $exts))
            return true;

    }

    function addPicture() {
        global $DB_DB;

        $name = md5(uniqid(rand(), true));
        $path = "uploaded/{$name}";
        $resultat = move_uploaded_file($_FILES['picture']['tmp_name'], $path);

        if(!$resultat)
            echo "Error.";

        $request = $DB_DB->prepare('INSERT INTO Picture(picture) VALUES(:picture)');

        try {
            $request->execute(array(
                'picture' => $name
            ));

            echo "Ok !";
        }
        catch(Exception $e) {
            echo $e;
            exit;
        }

    }

    function getPictureList() {
        global $DB_DB;
        return $DB_DB->query('SELECT picture, pictureDescription FROM Picture');

    }

    function deletePicture() {
        global $DB_DB;

        $request = $DB_DB->prepare('DELETE FROM Picture WHERE picture = :picture');

        try {
            $request->execute(array(
                'picture' => $_POST['picture']
            ));

            unlink ("uploaded/" . $_POST['picture']);
            echo "Ok !";
        }
        catch(Exception $e) {
            echo $e;
            exit;
        }
    }

?>
