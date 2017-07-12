<?php
loadModules("lab");

if(isset($_POST['update']) && !empty($_POST['update'])){
    $idLab = $_POST['idLab'];
    $labName = $_POST['labName'];

    if (empty($labName)){
        echo "Missing lab name";
    }

    else{
        updateLab($_POST['idLab'],$_POST['labName'], $_POST['labDescription'] );
        header('Location: index.php?page=lab');
    }
}



?>