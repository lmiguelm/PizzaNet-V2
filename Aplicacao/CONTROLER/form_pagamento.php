<?php
	include("autenticacao/autenticacao.php");
	include("autenticacao/autenticacao_cliente.php");


	$parametros = null;
	$parametros["reset"]=true;
	$parametros["modal"]=true;
	$parametros["nome_submit"]="Finzalizar Compra";
	$parametros["action"]="insere.php?tabela=pagamento";
	$parametros["method"]="POST";

	$f=new Form($parametros);

	$parametros=null;
	$vetor=null;
	$vetor[] = array("label"=>"Informe seu cartão");
	$vetor[] = array("value"=>"Visa","label"=>"Visa");
	$vetor[] = array("value"=>"MasterCard","label"=>"MasterCard");
	$vetor[] = array("value"=>"Elo","label"=>"Elo");
	$vetor[] = array("value"=>"Hipercard","label"=>"Hipercard");
	$vetor[] = array("value"=>"American","label"=>"American Express");
	$parametros["name"] = "bandeira";
	$parametros["class"] = "form-control";
	$parametros["id"] = "bandeira";
	$f->add_select($parametros,$vetor);

	$parametros=null;
	$parametros["id"]="numero";
	$parametros["name"]="numero";
	$parametros["type"]="text";
	$parametros["required"]="required";
	$parametros["placeholder"]="Numero do Cartão";
	$parametros["class"]="cartao form-control";
	$f->add_input($parametros);

	$parametros=null;
	$parametros["id"]="validade";
	$parametros["name"]="validade";
	$parametros["type"]="text";
	$parametros["required"]="required";
	$parametros["placeholder"]="Data de Validade";
	$parametros["class"]="data form-control";
	$f->add_input($parametros);

	$parametros=null;
	$parametros["id"]="titular";
	$parametros["name"]="titular";
	$parametros["type"]="text";
	$parametros["required"]="required";
	$parametros["placeholder"]="Nome Titular";
	$parametros["class"]="form-control";
	$f->add_input($parametros);

	$parametros=null;
	$parametros["id"]="total";
	$parametros["name"]="total";
	$parametros["type"]="hidden";
	$f->add_input($parametros);

	$parametros=null;
	$parametros["id"]="cod_pedido";
	$parametros["name"]="cod_pedido";
	$parametros["type"]="hidden";
	$f->add_input($parametros);


	$parametros=null;
	$parametros["modal_title"]="Pagamento";
	$parametros["btn_title"]="Finalizar Pagamento";
	$parametros["exibe"]=true;

	$m=new Modal($f, $parametros);

	$m->exibe();

?>

