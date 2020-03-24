<?php
	include("../VIEW/classeCabecalho.php");
	include("../MODEL/classeBancoDeDados.php");
		
	$operacao = new BancoDeDados($conexao);

	if($_GET["tabela"]=='pedido'){

		header('Access-Control-Allow-Origin: *');
   		header('Content-Type: application/json;charset=UTF-8');
		$host = "localhost";$db = "pizzanet2";$user = "root";$pass = "usbw";
		$conn = new mysqli($host, $user, $pass, $db);
   		$conn->set_charset("utf8");

		$id=$_GET["id"];

		$delete_item="DELETE FROM item_pedido WHERE cod_pedido=$id";
	    $conn->query($delete_item);

	    $delete_pedido="DELETE FROM pedido WHERE id_pedido=$id";
	    $conn->query($delete_pedido);

		$conn->close();
	}
	
	$operacao->remocao($_GET["tabela"],$_GET["id"]);
	
	header('location: listar_'.$_GET["tabela"].'.php?remove');

	include("../VIEW/classeRodape.php");
	$r=new Rodape($parametros);
	$r->exibe();
?>
