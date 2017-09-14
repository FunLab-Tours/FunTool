<?php
include("../include/config.php");
include("../include/lang.php");
include("../include/module.php");
include("../include/db.php");
loadModules("funnies");
$q=$_GET["q"];
$hint = searchUser($q)['login'];

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
    $response="no suggestion";
  } else {
    $response=$hint;
  }
  
  //output the response
//   echo $response;
  echo "LOOOOOOOL";
?>