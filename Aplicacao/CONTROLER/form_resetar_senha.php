<?php

	include("../VIEW/classeCabecalho.php");
	include("../VIEW/classeForm.php");
?>

	<div class=" text-center col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4">
		<img src="../img/pizzanet.png" height="250px" width="350px" />	
	</div>

<?php
	
	$parametros["action"]="enviar_resetar_senha.php";
	$parametros["method"]="post";
	
	$f = new Form($parametros);
	
	$parametros=null;
	$parametros["type"]="email";
	$parametros["name"]="email";
	$parametros["class"]="form-control";
	$parametros["required"]="required";
	$parametros["placeholder"]="Email cadastrado";
	$f->add_input($parametros);

	$parametros=null;
	$parametros["label"]= "Solicitar nova senha";
	$parametros["class"]="btn btn-success";
	$f->add_button($parametros);

	$f->exibe();
	

	include("../VIEW/classeRodape.php");
	
?>
