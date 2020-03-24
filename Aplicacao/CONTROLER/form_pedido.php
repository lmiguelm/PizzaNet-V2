<?php
	include("../VIEW/classeForm.php");
	include("autenticacao/autenticacao.php");
	include("autenticacao/autenticacao_cliente.php");

	$bd = new BancoDeDados($conexao);

	$tabela[]="pedido";
	$coluna[]="status";
	$condicao[]="status='aberto'";
	$condicao[] = 'cod_cliente='.$_SESSION["usuario"]->get_id().'';
	$ordenacao=null;

	$result = $bd->select($tabela,$coluna,$condicao,$ordenacao);

	if($result==null){

		echo
		'
		<div class="col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4">
			<img src="../img/pizzanet.png" class="img-fluid" heigth="200px"/>
		</div>
		';

		$parametros = null;
		$parametros["action"] = "insere.php?tabela=pedido";
		$parametros["method"] = "post";
		$f = new Form($parametros);

		$parametros=null;
		$parametros["name"]="cod_cliente";
		$parametros["type"]="hidden";
		$parametros["value"]=$_SESSION["usuario"]->get_id();	
		$f->add_input($parametros);

		$parametros["label"] = "Fazer um Pedido";
		$parametros["class"]="btn btn-primary";
		$f->add_button($parametros);
		
		$f->exibe();
	}
	else{
		echo"
			<div class='text-center'>
				<a href='form_item_pedido.php' class='btn btn-warning'>Retomar Pedido</a>
			</div>
		";
		$tabela=null; $coluna=null; $condicao=null; $ordenacao=null;

		$tabela[]="pedido";
		$coluna[]= "MAX(id_pedido) as id";
		$condicao[] = 'cod_cliente='.$_SESSION["usuario"]->get_id().'';
		$ordenacao = null;

		$result = $bd->select($tabela,$coluna,$condicao,$ordenacao);
		$id=$result[0]["id"];

		$parametros = null;
		$parametros["action"] = "cancelar_pedido.php";
		$parametros["method"] = "post";
		$f = new Form($parametros);

		$parametros=null;
		$parametros["name"]="id";
		$parametros["type"]="hidden";
		$parametros["value"]=$id;	
		$f->add_input($parametros);

		$parametros=null;
		$parametros["name"]="btn";
		$parametros["type"]="hidden";
		$parametros["value"]=$id;	
		$f->add_input($parametros);

		$parametros=null;
		$parametros["label"]="Cancelar Pedido";
		$parametros["class"]="btn btn-danger";
		$f->add_button($parametros);

		$f->exibe();
	}
?>
