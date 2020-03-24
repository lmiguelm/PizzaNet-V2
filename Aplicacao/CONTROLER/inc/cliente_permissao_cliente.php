<?php
	include("../VIEW/classeTabela.php");
	include("../MODEL/classeBancoDeDados.php");
	include("../VIEW/classeForm.php");

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
<div class=" text-center col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4">
	<img src="../img/pizzanet.png" height="250px" width="350px" />
</div>
<?php
	$tabela[]="cliente";

	$bd = new BancoDeDados($conexao);
	
	$coluna[]= "id_cliente as ID";
	$coluna[]= "nome as Nome";
	$coluna[]= "email as Email";
	$coluna[]= "endereco as Endereço";

	$condicao[]='id_cliente='.$_SESSION["usuario"]->get_id().'';
	$ordenacao=null;
	$m = $bd->select($tabela,$coluna,$condicao,$ordenacao);

	$t = new Tabela($m,"cliente",true,false);
	$t->exibe();
?>
