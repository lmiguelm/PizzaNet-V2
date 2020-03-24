<?php
	
	include("../VIEW/classeTabela.php");
	include("../MODEL/classeBancoDeDados.php");
	include("form_pedido.php");

	if (isset($_GET["pagamento"])) {
		echo'
			<br/>
			<div class="text-center">
				<p>Pedido pago!</p>
			</div>
			<br/>
		';
	}

	echo "<br/><br/>";

	$tabela=null;
	$coluna=null;
	$condicao=null;
	$ordenacao=null;
	$m=null;
		
	$tabela[]="visao_pedido_aberto";

	$coluna[]= "tipo as Tipo";
	$coluna[]= "item as Item";
	$coluna[]= "quantidade as Quantidade";
	$condicao[] = 'cod_cliente='.$_SESSION["usuario"]->get_id().'';
	$ordenacao = null;
	$m = $bd->select($tabela,$coluna,$condicao,$ordenacao);

	$t = new Tabela($m,"visao_pedido_aberto",false,false);
	$t->exibe();
?>