<?php
	
	include("../VIEW/classeCabecalho.php");
	include("../VIEW/classeTabela.php");
	include("../MODEL/classeBancoDeDados.php");

	include("form_funcionario.php");
	echo"<br/><br/>";

	if(isset($_GET["remove"]))
	{
		echo "<div class='text-center'><p class='white'>funcionario removido com sucesso!</p></div>";
	}
	if(isset($_GET["insere"]))
	{
		echo "<div class='text-center'><p class='white'>funcionario inserido com sucesso!</p></div>";
	}

	$tabela[]="funcionario";

	$bd = new BancoDeDados($conexao);
	
	$coluna[]= "id_funcionario as ID";
	$coluna[]= "nome as Nome";
	$coluna[]= "email as Email";
	$coluna[]= "salario as Salário";
	$coluna[]= "senha as Senha";

	$condicao=null;
	$ordenacao = null;
	$m = $bd->select($tabela,$coluna,$condicao,$ordenacao);


	$t = new Tabela($m,"funcionario",true,true);
	
	$t->exibe();

	include("../VIEW/classeRodape.php");
	
	
?>
