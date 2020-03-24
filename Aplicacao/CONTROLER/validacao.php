<?php

	include("../MODEL/conexao.php");
	include("../MODEL/classeValidacaoUsuario.php");

	$v = new ValidacaoUsuario($conexao,$_POST);

	$v->validar();
?>