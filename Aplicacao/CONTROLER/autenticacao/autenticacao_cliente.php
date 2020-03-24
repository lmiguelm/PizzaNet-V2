<?php
	if($_SESSION["usuario"]->get_permissao()==1){
		header("location: index.php?autenticacao");
	}
?>