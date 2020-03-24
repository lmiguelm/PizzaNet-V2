<?php
	include("autenticacao.php");
	
	if(!isset($_GET["sessao"]))
	{
		header("location: index.php");;
		session_start();
		session_destroy();
	}
	else
	{
		header("location: index.php?sessao=1");
		session_start();
		session_destroy();
	}
?>