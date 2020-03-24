<?php
	if($_SESSION["usuario"]->get_permissao()!=2){
		header("location: index.php?autenticacao");
	}
?>