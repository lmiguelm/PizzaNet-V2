<?php
	include("autenticacao/autenticacao.php");
	include("autenticacao/autenticacao_cliente.php");
	include("../VIEW/classeForm.php");
	include("../MODEL/conexao.php");

	$parametros = null;
	$parametros["reset"]=true;
	$parametros["modal"]=true;
	$parametros["action"] = "insere.php?tabela=cliente&form";
	$parametros["method"] = "post";
	$f = new Form($parametros);

	$parametros = null;
	$parametros["id"]="nome_cliente";
	$parametros["name"] = "nome";
	$parametros["type"] = "text";
	$parametros["placeholder"] = "Nome";	
	$parametros["class"]="form-control";
	$parametros["required"]="required";
	$f->add_input($parametros);
	
	$parametros = null;
	$parametros["id"]="email_cliente";
	$parametros["name"] = "email";
	$parametros["type"] = "email";
	$parametros["placeholder"] = "E-mail";	
	$parametros["class"]="form-control";
	$parametros["required"]="required";
	$f->add_input($parametros);	

	$parametros = null;
	$parametros["id"]="endereco";
	$parametros["name"] = "endereco";
	$parametros["type"] = "text";
	$parametros["placeholder"] = "Endereço";	
	$parametros["class"]="form-control";
	$parametros["required"]="required";
	$f->add_input($parametros);

	$parametros = null;
	$parametros["id"]="senha_cliente";
	$parametros["name"] = "senha";
	$parametros["type"] = "password";
	$parametros["placeholder"] = "Senha";	
	$parametros["class"]="form-control password";
	$parametros["data_cript"]="md5, sha1";
	$parametros["required"]="required";
	$f->add_input($parametros);

	$parametros = null;
	$parametros["name"] = "id";
	$parametros["type"] = "hidden";
	$parametros["value"] = 0;	
	$f->add_input($parametros);

	$parametros["modal_title"]="Formulário de Cliente";
	$parametros["btn_title"]="Cadastrar Nova Cliente";
	$parametros["exibe"]=1;

	$m=new Modal($f, $parametros);

	$m->exibe();
?>

