<?php

include("../include/config.php");
include("../include/lang.php");
include("../include/module.php");
include("../include/db.php");

loadModules("funnies");

$q = $_GET["q"];
$hint = searchUser($q)['login'];

// Set output to "no suggestion" if no hint was found.
// Or to the correct value.
if($hint == "")
	$response = "no suggestion";
else
	$response = $hint;

// Output the response.
// echo $response;
echo $response;
