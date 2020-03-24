<?php
	include("../VIEW/classeCabecalho.php");
	include("autenticacao/autenticacao.php");
	include("autenticacao/autenticacao_cliente.php");
	include("../VIEW/classeForm.php");
	
	echo "<br/>";
	$parametros = null;	
	$parametros["action"]="envia_mensagem.php";
	$parametros["method"] = "post";
	
	$f = new Form($parametros);
	
	$parametros = null;
	$parametros["name"] = "assunto";
	$parametros["type"] = "text";
	$parametros["placeholder"] = "Digite o assunto";	
	$parametros["class"]="form-control";
	$parametros["required"]="required";
	$f->add_input($parametros);

	$parametros = null;
	$parametros["name"] = "mensagem";
	$parametros["class"]="form-control";
	$parametros["placeholder"] = "Digite a mensagem";
	$parametros["required"]="required";
	$f->add_textarea($parametros);

	
	$parametros["label"]="Enviar";
	$parametros["class"]="btn btn-success";
	$f->add_button($parametros);
	$f->exibe();

	include("../VIEW/classeRodape.php");
	
?>