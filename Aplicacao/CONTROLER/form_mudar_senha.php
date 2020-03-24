<?php
	include("../VIEW/classeCabecalho.php");
	include("autenticacao/autenticacao.php");
	include("../VIEW/classeForm.php");

	echo'<div class=" text-center col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4">
			<img src="../img/pizzanet.png" height="250px" width="350px" />
		</div>
	';

	if(isset($_GET["success"])){
		echo "<div class='text-center'><p class='white'>Senha alterado com sucesso!</p></div>";
	}
	if(isset($_GET["erro"])){
		echo "<div class='text-center'><p class='white'>Ops! você digitou a senha atual errada. Tente novamente!</p></div>";
	}


	$parametros=null;
	$parametros["action"]='insere.php?mudarsenha&permissao='.$_SESSION["usuario"]->get_permissao().'';
	$parametros["method"]="POST";

	$f=new Form($parametros);

	$parametros=null;
	$parametros["name"]="id";
	$parametros["type"]="hidden";
	$parametros["value"]=$_SESSION["usuario"]->get_id();
	$f->add_input($parametros);

	$parametros=null;
	$parametros["name"]="senha_atual";
	$parametros["type"]="password";
	$parametros["placeholder"]="Digite sua senha atual";
	$parametros["required"]="required";
	$parametros["class"]="form-control password";
	$parametros["data_cript"]="md5, sha1";
	$f->add_input($parametros);

	$parametros=null;
	$parametros["name"]="senha";
	$parametros["type"]="password";
	$parametros["placeholder"]="Digite sua nova senha";
	$parametros["required"]="required";
	$parametros["class"]="form-control password";
	$parametros["data_cript"]="md5, sha1";
	$f->add_input($parametros);

	$parametros=null;
	$parametros["name"]="senha";
	$parametros["type"]="password";
	$parametros["placeholder"]="Repita a senha";
	$parametros["required"]="required";
	$parametros["class"]="form-control password";
	$parametros["data_cript"]="md5, sha1";
	$f->add_input($parametros);

	$parametros=null;
	$parametros["label"]="Mudar Senha";
	$parametros["class"]="btn btn-success";
	$f->add_button($parametros);

	$f->exibe();


	include("../VIEW/classeRodape.php");
?>