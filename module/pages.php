<?php
// TODO : redirect to create a lab if there isn't in the database.
	include('include_static/header.php');
	include('include_static/menu.php');

	if(isset($_COOKIE['id']) && sha1($_COOKIE['id'] . $privateKey) == $_COOKIE['token']){
		if(isset($_GET['page']) && file_exists('view/' . $_GET['page'] . '/index.php')){
	        include('view/' . $_GET['page'] . '/index.php');
	    }
		else{
	        include('view/home/index.php');
	    }
	}
	else{
		if(isset($_GET['page']) && file_exists('view/unconnected/' . $_GET['page'] . '.php')){
			include('view/unconnected/' . $_GET['page'] . '.php');
		}
		else{
			include('view/unconnected/login.php');
		}
	}    

	include('include_static/footer.php');

?>
