<?php
	include("../VIEW/classeCabecalho.php");	
	include("autenticacao/autenticacao.php");
	
	$emissor='pizzanetifsp@gmail.com';
	$nome_emissor='PizzaNet';

	$receptor=$_SESSION["usuario"]->get_email();
	$nome_receptor=$_SESSION["usuario"]->get_nome();
	
	$subject = $_POST["assunto"];
	$mensagem = $_POST["mensagem"];
	
	include("email.php");
	include("../VIEW/classeRodape.php");
?>	
	