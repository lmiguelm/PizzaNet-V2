<?php
	include("../VIEW/classeForm.php");
	include("autenticacao/autenticacao.php");
	include("autenticacao/autenticacao_admin.php");
	include("../MODEL/conexao.php");
	
	$parametros = null;
	$parametros["action"] = "insere.php?tabela=funcionario";
	$parametros["method"] = "post";
	$parametros["modal"]=true;
	$parametros["reset"]=true;
	$f = new Form($parametros);

	$parametros = null;
	$parametros["id"]="nome_funcionario";
	$parametros["name"] = "nome";
	$parametros["type"] = "text";
	$parametros["placeholder"] = "Nome";	
	$parametros["class"]="form-control";
	$parametros["required"]="required";
	$f->add_input($parametros);

	$parametros = null;
	$parametros["id"]="salario";
	$parametros["name"] = "salario";
	$parametros["type"] = "text";
	$parametros["placeholder"] = "Salário";	
	$parametros["class"]="dinheiro form-control";
	$parametros["required"]="required";
	$f->add_input($parametros);
	
	$parametros = null;
	$parametros["id"]="email_funcionario";
	$parametros["name"] = "email";
	$parametros["type"] = "email";
	$parametros["placeholder"] = "E-mail";	
	$parametros["class"]="form-control";
	$parametros["required"]="required";
	$f->add_input($parametros);

	$parametros = null;
	$parametros["id"]="senha_funcionario";
	$parametros["name"] = "senha";
	$parametros["type"] = "password";
	$parametros["placeholder"] = "Senha";	
	$parametros["class"]="form-control";
	$parametros["data_cript"]="md5, sha1";
	$parametros["required"]="required";
	$f->add_input($parametros);

	$parametros = null;
	$parametros["name"] = "id";
	$parametros["type"] = "hidden";
	$parametros["value"] = 0;	
	$f->add_input($parametros);

	$parametros["modal_title"]="Formulário de Funcionário";
	$parametros["btn_title"]="Cadastrar Novo Funcionário";
	$m=new Modal($f, $parametros);

	$m->exibe();
?>

