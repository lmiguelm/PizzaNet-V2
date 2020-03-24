<?php
	include("../VIEW/classeCabecalho.php");
	include("autenticacao/autenticacao.php");
	
	if($_SESSION["usuario"]->get_permissao()==2)
	{
		include("inc/cliente_permissao_admin.php");
	}
	else
	{
		include("inc/cliente_permissao_cliente.php");
	}
	
	include("../VIEW/classeRodape.php");	
	
?>
