<?php
	include("../VIEW/classeCabecalho.php");
?>
<div class=" text-center col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4">
	<img src="../img/pizzanet.png" height="250px" width="350px" />
	<?php
		if(!isset($_SESSION["usuario"])){

            if(isset($_GET["sucesso"])){
                echo'<h2>'.$_GET["nome"].' cadastrado!</h2>';
            }
            elseif(isset($_GET["email"])){
                echo"<h2>Este email já foi cadastrado</h2>";
            }
            else{

                echo"<h2>Criar uma nova conta</h2>";
            }

			echo
			'
			<form action="insere.php?tabela=cliente" method="post">
                <div class="row">
                    <div class="input-group col-sm-12 col-xs-12">
                        <input type="text" name="nome" id="nome" required="required" class="form-control" placeholder="Nome Completo" />
                    </div>
                </div><br/>

                 <div class="row">
                    <div class="input-group col-sm-12 col-xs-12">
                        <input type="text" name="endereco" required="required" class="form-control" placeholder="Endereço"/>
                    </div>
                </div><br/>

                <div class="row">
                    <div class="input-group col-sm-12 col-xs-12">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping">@</span>
                      </div>
                      <input type="email" class="form-control" placeholder="Email" required="required" name="email" aria-describedby="addon-wrapping">
                    </div>
                </div><br/>

                <div class="row">
                   <div class="input-group col-sm-6 col-xs-12">
                        <input type="password" name="senha" id="senha" required="required" class="form-control password" placeholder="Senha" data-cript="md5, sha1"/>
                    </div>
               
                    <div class="input-group col-sm-6 col-xs-12">
                        <input type="password" name="senha" id="senhaConfirmacao" required="required" placeholder="Digite novamente" class="form-control password" data-cript="md5, sha1"/>
                    </div>
                </div><br/>

                <input type="hidden" name="permissao" value="0"/>	 

                <button type="submit" class="btn btn-primary">Inscreva-se</button>  
            </form>
			';
		}
		else{

            if(isset($_GET["autenticacao"])){
                echo"<div class='text-center'><h2>Página não autorizada!</h2></div>";
            }
            else{
                echo"<div class='text-center'><h1 class='muda' alt='caixa'>Bem-vindo ".$_SESSION['usuario']->get_nome()."</h1></div>";   
                
            }
			
		}
		
	?>
</div>
<?php
	include("../VIEW/classeRodape.php");
  
?>


