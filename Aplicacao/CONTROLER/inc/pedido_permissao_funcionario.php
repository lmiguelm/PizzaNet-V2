<div class='container text-center'>
	<div class=" text-center col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4">
		<img src="../img/pizzanet.png" height="250px" width="350px" />
	</div>
	<div class='table-responsive'>
		<table class='table table-sm table-hover table-dark text-center table_aprova'>
			<thead>
				<tr>
					<th>Id do Pedido</th>
					<th>Data e Horario</th>
					<th>Nome do Cliente</th>
					<th>Preço</th>
					<th>Status</th>
					<th colspan="3">Ações</th>
				</tr>
			</thead>

			<tbody id="pedido_aprova_funcionario">
				
			</tbody>
			<span id="id_funcionario"><?php echo $_SESSION["usuario"]->get_id();?></span>
			<span id="func" value="1"></span>
		</table>
		<h1 id="texto"></h1>
	</div>
	<div class='table-responsive' id="mostrar_pedido">
		<table class='table table-sm table-hover table-dark text-center table_aprova'>
			<thead>
				<tr>
					<th>Tipo</th>
					<th>Item</th>
					<th>Quantidade</th>
				</tr>
			</thead>

			<tbody id="mostar_pedido">
				
			</tbody>
		</table>
		<button class="btn btn-danger" id="btn_fechar_pedido">Fechar</button>
	</div>
</div>
