$(function(){

	$('#cod_pizza2').hide();
	$('#cod_pizza1').hide();
	$('#cod_bebida').hide();
	$('#proporcao').hide();
	$("#table_carrinho").hide();
	$('#mostrar_pedido').hide();

	var url="http://localhost:8083/DESENVOL/PizzaNet2/CONTROLER/";

	//função que adiciona um novo item do pedido
	function onBtnAddItemClick(){	
		
		$.ajax({
			url: url+"insere.php?tabela=item_pedido",
			method:"post",
			data: {tipo: $("select[name='tipo']").val(),cod_bebida: $("select[name='cod_bebida']").val(), proporcao: $("select[name='proporcao']").val(), cod_pizza1:$("select[name='cod_pizza1']").val(),cod_pizza2:$("select[name='cod_pizza2']").val(),cod_pedido:$("input[name='cod_pedido']").val(), quantidade:$("input[name='quantidade']").val()},
			success: function(){
				loadCarrinho();	
			}		
		})
	};

	//função que busca os itens de pedidos inseridos no banco
	function loadCarrinho(){
		$("#carrinho").empty();

	    $.getJSON(url+'listar_item_pedido.php')
	        .done(function(data){

	        	if(data.length > 0){
	        		$("#table_carrinho").show('slow');
	        	}

	            for(var i = 0; i < data.length; i++){
	                addCarrinho(data[i].id_item_pedido, data[i].quantidade, data[i].preco_pedido, data[i].tipo, data[i].item);
	            }
	        })
	}

	//função que recebe os dados do banco e inseram na tabela
	function addCarrinho(id_item_pedido, quantidade, preco_pedido, tipo, item){
		
		var $carrinho = $('<tr />')
	    .addClass('carrinho-item')

	    .append($('<td />')
	        .addClass('item-id_item_pedido')
	        .text(id_item_pedido))

	    .append($('<td />')
	        .addClass('text-center item-tipo')
	        .text(tipo))

	    .append($('<td />')
	        .addClass('text-center item-item_pedido')
	        .text(item))

	    .append($('<td />')
	        .addClass('text-center item-quantidade')
	        .text(quantidade))

	    .append($('<td />')
	        .addClass('text-center item-preco')
	        .text(preco_pedido))

	    .append($('<td/>').addClass('text-center')
	    	.append($('<div/>').addClass('text-center item-delete')
				.append($('<i/>').addClass('material-icons text-danger').attr('data-toggle', 'tooltip').attr('title', 'Excluir').text('delete'))));

		$('#carrinho').append($carrinho);
		$('.item-delete').click(onItemDeleteClick);	
		$('[data-toggle="tooltip"]').tooltip();
		PrecoFinalPedido();	
	}

	//função que atualiza o preço do pedido
	function PrecoFinalPedido()
	{
		var carrinho = $('.carrinho-item');
		var total=0;
		

		for(var i=0; i<carrinho.length; i++)
		{
			var $item = $(carrinho[i]);

			var quantidade = parseInt($item.find('.item-quantidade').text());
			var preco = parseInt($item.find('.item-preco').text());
			
			total+=quantidade*preco;
		}

		var texto=(total<1 ? '0' : '') + Math.floor(total*100);

		texto='R$ '+texto;

		texto=texto.substr(0, texto.length - 2) +','+ texto.substr(-2);

		$('#total').text(texto);	
	}

	//função que apaga um item quando clicado
	function onItemDeleteClick(){

		var linha=$(this).closest('.carrinho-item');

		linha.hide('slow', function(){
			var id_item_pedido=linha.children('.item-id_item_pedido').text();
			$.get(url+'remover.php', {id: id_item_pedido, tabela: "item_pedido"}, );

			linha.remove();
			PrecoFinalPedido();
		})
	}

	//função para habilitar e desabilitar o select de meia pizza
	function onMudarProporcao(){

		var proporcao=$('#proporcao').val()
			
		if(proporcao==1){
			$('#cod_pizza1').show('slow');
			$('#cod_pizza2').hide('slow');
		}
		else if(proporcao==2){
			$('#cod_pizza2').show('slow');
			$('#cod_pizza1').show('slow');
		}
		else{
			$('#cod_pizza1').hide('slow');
			$('#cod_pizza2').hide('slow');
		}
	}

	//função de apagar o pedido
	function onBtnApagaPedido(){

		var id_pedido=$(this).val();
		$.post(url+'cancelar_pedido.php', {id: id_pedido},);
		window.location.href=url+"listar_pedido.php";	
	}

	//funcao acionada quando o cliente confirmar o pedido
	function onBtnConfirmaPedido(){

		var id_pedido=$(this).val();
		var total=$("#total").text();


		$('#cod_pedido').val(id_pedido);
		$('input[name=total]').val(total);

		$('#NovoCadastro').modal();
	}

	//função para esconder/mostrar os campos pizza ou bebida
	function onMudarTipo(){

		var tipo=$('#tipo').val()
			
		if(tipo==1){
			$('#proporcao').show('slow');
			$('#cod_bebida').hide('slow');
		}

		else if(tipo==2){
			$('#cod_bebida').show('slow');
			$('#proporcao').hide('slow');
			$('#cod_pizza1').hide('slow');
			$('#cod_pizza2').hide('slow');
		}

		else{
			$('#cod_pizza2').hide('slow');
			$('#cod_pizza1').hide('slow');
			$('#cod_bebida').hide('slow');
			$('#proporcao').hide('slow');
		}
	}

	//funçãop para buscar na view os pedidos que não foram atendidos por nenhum funcionario
	function loadFuncionario(){
		$("#pedido_aprova_funcionario").empty();

	    $.getJSON(url+'listar_funcionario_pedido.php')
	        .done(function(data){

	        	if(data.length == 0){
	        		$(".table_aprova").hide();
	        		
	        		$("#texto").append('Não há novos pedidos no momento. :)');
	        	}

	        	if(data.length < 0){
	        		$(".table_aprova").show('slow');
	        	}

	            for(var i = 0; i < data.length; i++){
	                addTableFuncionario(data[i].id_pedido, data[i].horario, data[i].nome, data[i].status_pedido, data[i].total);
	            }
	        })
	}

	//função que recebe os dados e poem na tabela
	function addTableFuncionario(id_pedido, horario, nome, status_pedido, total){
		
		var $pedido = $('<tr />').addClass('pedido-item')

		    .append($('<td />')
		        .addClass('text-center item-id_pedido')
		        .text(id_pedido))

		    .append($('<td />')
		        .addClass('text-center item-horario')
		        .text(horario))

		    .append($('<td />')
		        .addClass('text-center item-nome')
		        .text(nome))

		     .append($('<td />')
		        .addClass('text-center item-total')
		        .text(total))

		   .append($('<td/>').addClass('item-status_pedido')
				.append($('<span/>').addClass(function(){
					switch(status_pedido)
					{
						case "Novo": return'badge badge-danger';
						case "Preparando": return'badge badge-warning';
						case "Rota de Entrega": return'badge badge-primary';
						case "Entregue": return'badge badge-success';
					}
				})
				.text(status_pedido)))
   	
		  
			.append($('<td/>').addClass('item-change-status')
				.append($('<i/>').addClass('material-icons text-primary').attr('data-toggle', 'tooltip').attr('title', 'Mudar status').text('autorenew')))

			.append($('<td/>').addClass('text-center item-ver_pedido')
				.append($('<i/>').addClass('material-icons text-warning').attr('data-toggle', 'tooltip').attr('title', 'Detalhes do Pedido').text('search')))

		    
    		.append($('<td/>').addClass('text-center item-atendido')
				.append($('<i/>').addClass('material-icons text-success').attr('data-toggle', 'tooltip').attr('title', 'Finalizar').text('check')));

			$('#pedido_aprova_funcionario').append($pedido);	
			$('.item-ver_pedido').click(onVerItemPedido)
			$('.item-change-status').click(onPedidoChangeStatusClick);
			$('.item-atendido').click(onPreencherCodFuncionario);
			$('[data-toggle="tooltip"]').tooltip();
	}


	//função que resgata os itens de pedido do pedido clicado e insere em uma tabela
	function onVerItemPedido(){

		var linha=$(this).closest('.pedido-item');
		var id=linha.children('.item-id_pedido').text();

		$.ajax({
			url: url+"listar_item_pedido.php",
			method:"post",
			data: {id:id},
			success: function(data){

				$("#mostar_pedido").empty();
	            for(var i = 0; i < data.length; i++){
	                mostarPedido(data[i].quantidade, data[i].tipo, data[i].item);
	            }

	            function mostarPedido(quantidade, tipo, item){

	            	var $mostrar = $('<tr />')

					    .addClass('carrinho-item')

					    .append($('<td />')
					        .addClass('text-center item-tipo')
					        .text(tipo))
					    
					    .append($('<td />')
					        .addClass('text-center item-item_pedido')
					        .text(item))

					    .append($('<td />')
					        .addClass('text-center item-quantidade')
					        .text(quantidade));			 

					$('#mostar_pedido').append($mostrar);
					$('#mostrar_pedido').show('slow');
						
	            }
	        }
		})
	}

	//função para fechar a tabela de mostrar os detalhes do pedido
	function onFecharPedido(){
		$('#mostrar_pedido').hide('slow');
	}

	//função para mudar o status do pedido
	function onPedidoChangeStatusClick(){

		var linha=$(this).closest('.pedido-item')
		var id=linha.children('.item-id_pedido').text();
		var status=linha.children('.item-status_pedido').text();
		
		switch(status){
			case 'Novo': status='Preparando';
			break;

			case 'Preparando': status='Rota de Entrega';
			break;

			case 'Rota de Entrega': status='Entregue';
			break;

			case 'Entregue': status='Entregue';
		}

		$.post(url+'/mudarStatusPedido.php', {id, status_pedido: status}, 
		function(){
			location.reload(true);
		});
	}

	//função para o funcionario finalizar o pedido quando for entregue
	function onPreencherCodFuncionario(){
		
		var linha=$(this).closest('.pedido-item');

		linha.hide('slow', function(){

			var id=linha.children('.item-id_pedido').text();
			var id_funcionario=$('#id_funcionario').text();
			$.post(url+'pedidoAprovado.php', {id: id, cod_funcionario: id_funcionario});

			linha.remove();
			loadFuncionario();
		})	
	}

	//função de logout
	function onBtnLogoutClick(){
		$.get(url+'logout.php').done(function(){
			window.location.href='index.php';
		})
	}

	function onBtnSenhaClick(){
		window.location.href=url+'form_mudar_senha.php';
	}

	//função para o cliente ver os dados dele
	function onBtnDadosClick(){
		window.location.href=url+'listar_cliente.php';
	}

	//função para o cliente mandar mensagem para o suporte
	function onBtnFaleClick(){
		window.location.href=url+'form_contato.php';
	}
	
	loadCarrinho();
	loadFuncionario();
	$('#btnDados').click(onBtnDadosClick);
	$('#btnSenha').click(onBtnSenhaClick);
	$('#btnLogout').click(onBtnLogoutClick);
	$('#btnFale').click(onBtnFaleClick);
	$('#proporcao').change(onMudarProporcao);
	$("#btn_add_item").click(onBtnAddItemClick);
	$("#btn_pedido_cancelado").click(onBtnApagaPedido);
	$("#btn_pedido_realizado").click(onBtnConfirmaPedido);
	$("#tipo").change(onMudarTipo);
	$("#btn_fechar_pedido").click(onFecharPedido);


	//Mascara dos formulários
	$('.dinheiro').mask('#.##0,00', {reverse: true});
    $('.horas').mask('00:00');
    $('.cartao').mask('0000 0000 0000 0000');
    $('.telefone').mask('(00) 000000000');
    $('.data').mask("00/00/0000");
});