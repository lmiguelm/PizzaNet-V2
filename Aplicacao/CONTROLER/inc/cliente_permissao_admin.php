<?php
	include("form_cliente.php");
	include("../VIEW/classeTabela.php");
	include("../MODEL/classeBancoDeDados.php");

	echo'<div class=" text-center col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4">
			<img src="../img/pizzanet.png" height="250px" width="350px" />
		</div>
	';

	if(isset($_GET["remove"]))
	{
		echo "<div class='text-center'><p class='white'>Cliente removido com sucesso!</p></div>";
	}
	if(isset($_GET["insere"]))
	{
		echo "<div class='text-center'><p class='white'>Cliente inserido com sucesso!</p></div>";
	}

	$tabela[]="cliente";

	$bd = new BancoDeDados($conexao);
	
	$coluna[]= "id_cliente as ID";
	$coluna[]= "nome as Nome";
	$coluna[]= "email as Email";
	$coluna[]= "endereco as Endereco";
	$coluna[]= "senha as Senha";

	$condicao[]="id_cliente!=2";
	$ordenacao="nome";
	$m = $bd->select($tabela,$coluna,$condicao,$ordenacao);

	$t = new Tabela($m,"cliente",true,true);
	$t->exibe();
?>