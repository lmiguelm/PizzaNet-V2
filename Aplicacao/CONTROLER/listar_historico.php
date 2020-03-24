<?php
	include("../VIEW/classeCabecalho.php");
	include("autenticacao/autenticacao.php");
	include("autenticacao/autenticacao_cliente.php");
	include("../VIEW/classeTabela.php");
	include("../MODEL/classeBancoDeDados.php");

	$bd = new BancoDeDados($conexao);
		
	$tabela[]="visao_historico_pedido";

	$coluna[]= "cod_pedido as 'Id do Pedido'";
	if ($_SESSION["usuario"]->get_permissao() == 0){
		
		$condicao[] = 'cod_cliente='.$_SESSION["usuario"]->get_id().'';
	}
	else{
		$condicao=null;
		$coluna[]= "nome as Cliente";
	}
	
	
	$coluna[]= "horario as 'Data e Hora'";
	$coluna[]= "total as 'Preço Pago'";
	
	$ordenacao = null;
	$m = $bd->select($tabela,$coluna,$condicao,$ordenacao);

	if($m!=null){
		echo'
			<div class="col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4">
				<img src="../img/pizzanet.png" class="img-fluid" heigth="200px"/>
			</div>
		';
		
		$t = new Tabela($m,"visao_historico_pedido",false,false);
		$t->exibe();
	}
	else{
		echo 
		"
			<div class='text-center'>
				<h1>Você ainda não realizou nenhum pedido.</h1>
			</div>
		";
	}
	include("../VIEW/classeRodape.php");
?>