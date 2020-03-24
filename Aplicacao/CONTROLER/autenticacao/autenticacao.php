<?php
	if(!isset($_SESSION["usuario"])){
		die(header("location: index.php"));
	}
?>