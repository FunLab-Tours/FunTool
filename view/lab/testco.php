<?php
//fichier inutile de test
    include('db.php');
    include('config.php');
    include('functions.php');

   function test ()
   {
    global $DB_DB;
    $sql="INSERT INTO Lab (labName, labDescription) VALUES ('agrrrr', 'agrrrrr')";
    $result = $DB_DB->query($sql);
    //return $result;
   }
   addLab('pipiz', 'pipiz');
   test();

?>