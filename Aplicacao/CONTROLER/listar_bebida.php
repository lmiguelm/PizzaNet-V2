<?php
	
	include("../VIEW/classeCabecalho.php");
	include("../VIEW/classeTabela.php");
	include("../MODEL/classeBancoDeDados.php");
	
	if($_SESSION["usuario"]->get_permissao()!=0){
		include("form_bebida.php");
		echo"<br/><br/>";
		if(isset($_GET["remove"])){
			echo "<center>Bebida removido com sucesso!</center>";
		}
		if(isset($_GET["insere"])){
			echo "<center>Bebida inserida com sucesso!</center>";
		}

	}
	else{
		echo
		'
			<div class="col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4">
				<img src="../img/pizzanet.png" class="img-fluid" heigth="200px"/>
			</div>
		';
	}

	
	$tabela[]="bebida";

	$bd = new BancoDeDados($conexao);
	
	$coluna[]= "id_bebida as ID";
	$coluna[]= "nome as Bebida";
	$coluna[]= "descricao as Descrição";
	$coluna[]= "preco as Preço";

	$condicao = null;
	$ordenacao = "nome";
	$m = $bd->select($tabela,$coluna,$condicao,$ordenacao);

	if($_SESSION["usuario"]->get_permissao()!=0){
		$t = new Tabela($m,"bebida",true,true);
	}else{
		$t = new Tabela($m,"bebida",false,false);
	}
	
	$t->exibe();
	include("../VIEW/classeRodape.php");
?>

