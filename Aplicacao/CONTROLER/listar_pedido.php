<?php
	include("../VIEW/classeCabecalho.php");

	if($_SESSION["usuario"]->get_permissao()==0)
	{
		include("inc/pedido_permissao_cliente.php");
	}	
	elseif($_SESSION["usuario"]->get_permissao()==1)
	{
		include("inc/pedido_permissao_funcionario.php");
	}
	else
	{
		include("inc/pedido_permissao_admin.php");
	}

	include("../VIEW/classeRodape.php");
	
?>