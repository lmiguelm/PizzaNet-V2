$(function(){


	var url="http://localhost:8083/DESENVOL/PizzaNet2/CONTROLER/";

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

	loadCarrinho();
})