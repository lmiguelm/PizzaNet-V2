<?php
	if($_SESSION["usuario"]->get_permissao()==0){
		header("location: index.php?autenticacao");
	}
?>