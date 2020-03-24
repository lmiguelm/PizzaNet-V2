<?php
	include("../VIEW/classeForm.php");
	include("autenticacao/autenticacao.php");
	include("autenticacao/autenticacao_funcionario.php");
	include("../MODEL/conexao.php");
	
	$parametros = null;
	$parametros["reset"]=true;
	$parametros["modal"]=true;
	$parametros["action"]="insere.php?tabela=bebida";
	$parametros["method"]="POST";
	$f = new Form($parametros);
	
	$parametros = null;
	$parametros["id"]="nome_bebida";
	$parametros["name"] = "nome";
	$parametros["type"] = "text";
	$parametros["placeholder"] = "Nome da bebida";	
	$parametros["class"]="form-control";
	$parametros["required"]="required";
	$f->add_input($parametros);

	$parametros = null;
	$parametros["id"]="descricao_bebida";
	$parametros["name"] = "descricao";
	$parametros["type"] = "text";
	$parametros["placeholder"] = "Descrição";	
	$parametros["class"]="form-control";
	$parametros["required"]="required";
	$f->add_input($parametros);
	
	$parametros = null;
	$parametros["id"]="preco_bebida";
	$parametros["name"] = "preco";
	$parametros["type"] = "text";
	$parametros["placeholder"] = "Preço";	
	$parametros["class"]="dinheiro form-control";
	$parametros["required"]="required";
	$f->add_input($parametros);	

	$parametros = null;
	$parametros["name"] = "id";
	$parametros["type"] = "hidden";
	$parametros["value"] = 0;	
	$f->add_input($parametros);
	
	$parametros=null;
	$parametros["modal_title"]="Formulário de Bebida";
	$parametros["btn_title"]="Cadastrar Nova Bebida";
	$m=new Modal($f, $parametros);

	$m->exibe();
?>
