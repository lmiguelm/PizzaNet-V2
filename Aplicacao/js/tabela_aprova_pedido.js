$(function(){

	var url="http://localhost:8083/DESENVOL/PizzaNet2/CONTROLER/";

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

	loadFuncionario();

})