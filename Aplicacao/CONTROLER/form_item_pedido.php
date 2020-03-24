<?php

	include("../VIEW/classeCabecalho.php");
	include("../VIEW/classeForm.php");
	include("autenticacao/autenticacao.php");
	include("autenticacao/autenticacao_cliente.php");
	include("../MODEL/conexao.php");
	include("../MODEL/classeBancoDeDados.php");
	echo "<br/><br/>";

	$operacao = new BancoDeDados($conexao);

	$tabela[]="pedido";
	$coluna[]= "MAX(id_pedido) as id";
	$condicao[] = 'cod_cliente='.$_SESSION["usuario"]->get_id().'';
	$ordenacao = null;

	$m = $operacao->select($tabela,$coluna,$condicao,$ordenacao);
	$id_pedido = $m[0]["id"];

	$_SESSION["id_pedido"]=$id_pedido;

	$parametros = null;
	$f = new Form($parametros);

	$parametros=null;
	$parametros["name"]="cod_pedido";
	$parametros["type"]="hidden";
	$parametros["value"]=$id_pedido;
	$f->add_input($parametros);

	$parametros=null;
	$vetor=null;
	$vetor[] = array("label"=>"Selecione o item");
	$vetor[] = array("value"=>"1","label"=>"Pizza");
	$vetor[] = array("value"=>"2","label"=>"Bebida");
	$parametros["name"] = "tipo";
	$parametros["class"] = "form-control";
	$parametros["id"] = "tipo";
	$f->add_select($parametros,$vetor);

	
	$parametros=null;
	$vetor=null;
	$vetor[] = array("label"=>"Selecione a proporção");
	$vetor[] = array("value"=>"1","label"=>"Inteira");
	$vetor[] = array("value"=>"2","label"=>"Meia");
	$parametros["name"] = "proporcao";
	$parametros["class"] = "form-control";
	$parametros["id"] = "proporcao";
	$f->add_select($parametros,$vetor);

	
	$parametros=null;
	$consulta = "SELECT id_pizza as value, nome as label FROM pizza ORDER BY nome";
	$stmt = $conexao->prepare($consulta);
	$stmt->execute();
	while($linha=$stmt->fetch()){
		$pizzas[] = $linha;
	}	
	$parametros["name"]="cod_pizza1";
	$parametros["id"]="cod_pizza1";
	$parametros["class"]="form-control";
	$f->add_select($parametros, $pizzas);

	$parametros=null;
	$pizzas=null;
	$consulta = "SELECT id_pizza as value,nome as label FROM pizza ORDER BY nome";
	$stmt = $conexao->prepare($consulta);
	$stmt->execute();
	while($linha=$stmt->fetch()){
		$pizzas[] = $linha;
	}	
	$parametros["name"]="cod_pizza2";
	$parametros["id"]="cod_pizza2";
	$parametros["class"]="form-control";
	$f->add_select($parametros, $pizzas);

	$parametros=null;
	$consulta = "SELECT id_bebida as value, nome as label FROM bebida ORDER BY nome";
	$stmt = $conexao->prepare($consulta);
	$stmt->execute();
	while($linha=$stmt->fetch()){
		$bebidas[] = $linha;
	}	
	$parametros["name"]="cod_bebida";
	$parametros["id"]="cod_bebida";
	$parametros["class"]="form-control";
	$f->add_select($parametros, $bebidas);

	$parametros=null;
	$parametros["name"]="quantidade";
	$parametros["type"]="number";
	$parametros["class"]="form-control";
	$parametros["min"]=1;
	$parametros["placeholder"]="Quantidade";
	$f->add_input($parametros);
		
	$f->exibe();

	$parametros["label"] = "Adicionar ao Pedido";
	$parametros["id"] = "btn_add_item";
	$parametros["class"]="btn btn-primary";
	$b = new Button($parametros);
	$b->exibe();
?>
	<br/><br/>
	
	<div class='container' id="table_carrinho">
			<div class='table-responsive'>
				<table class='table table-sm table-hover table-dark text-center'>
					<thead>
						<tr>
							<th>Id</th>
							<th>Tipo</th>
							<th>Pedido</th>
							<th>Quantidade</th>
							<th>Preço</th>
							<th>Ações</th>
						</tr>
					</thead>

					<tbody id="carrinho">
						
					</tbody>

					<tfoot class="rodape">
						<tr>
							<th colspan="6">&nbsp;</th>		
						</tr>
						<tr>
							<th class="red text-center"  colspan="6">
								Total: <span class="red text-center" id="total"></span> 
							</th>
						</tr>
				
					</tfoot>
				</table>
			</div>
			<br/>
			<div class="text-center">
				<button class="btn btn-danger" id="btn_pedido_cancelado" value="<?php echo $id_pedido?>">Cancelar Pedido</button>&nbsp;&nbsp;&nbsp;&nbsp;
				<button class="btn btn-success" id="btn_pedido_realizado" value="<?php echo $id_pedido?>">Finalizar Pedido</button>
			</div>
		</div>
		
	

<?php
	include("form_pagamento.php");

	include("../VIEW/classeRodape.php");
	
?>
