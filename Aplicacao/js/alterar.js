$(function(){

	function alterarDadosCliente()
	{
		var id=$(this).closest("tr").children("td:nth-child(1)").html();
		var nome=$(this).closest("tr").children("td:nth-child(2)").html();
		var email=$(this).closest("tr").children("td:nth-child(3)").html();
		var endereco=$(this).closest("tr").children("td:nth-child(4)").html();
		var senha=$(this).closest("tr").children("td:nth-child(5)").html();

		$('#nome_cliente').val(nome);
		$('#email_cliente').val(email);
		$('#endereco').val(endereco);
		$('#senha_cliente').val(senha);
		$('input[name=id]').val(id);
		
		$('#NovoCadastro').modal();
	}

	function alterarDadosPizza()
	{
		var id=$(this).closest("tr").children("td:nth-child(1)").html();
		var nome=$(this).closest("tr").children("td:nth-child(2)").html();
		var descricao=$(this).closest("tr").children("td:nth-child(3)").html();
		var preco=$(this).closest("tr").children("td:nth-child(4)").html();
		
		$('input[name=id]').val(id);
		$('#nome_pizza').val(nome);
		$('#descricao_pizza').val(descricao);
		$('#preco_pizza').val(preco);
		
		$('#NovoCadastro').modal();
	}

	function alterarDadosBebida(){

		var id=$(this).closest("tr").children("td:nth-child(1)").html();
		var nome=$(this).closest("tr").children("td:nth-child(2)").html();
		var descricao=$(this).closest("tr").children("td:nth-child(3)").html();
		var preco=$(this).closest("tr").children("td:nth-child(4)").html();

		$('input[name=id]').val(id);
		$('#nome_bebida').val(nome);
		$('#descricao_bebida').val(descricao);
		$('#preco_bebida').val(preco);

		$('#NovoCadastro').modal();
	}

	function alterarDadosFuncionario(){

		var id=$(this).closest("tr").children("td:nth-child(1)").html();
		var nome=$(this).closest("tr").children("td:nth-child(2)").html();
		var email=$(this).closest("tr").children("td:nth-child(3)").html();
		var salario=$(this).closest("tr").children("td:nth-child(4)").html();
		var senha=$(this).closest("tr").children("td:nth-child(5)").html();

		$('#nome_funcionario').val(nome);
		$('#email_funcionario').val(email);
		$('#salario').val(salario);
		$('#senha_funcionario').val(senha);
		$('input[name=id]').val(id);
		
		$('#NovoCadastro').modal();
	}

	$('#NovoCadastro').on('hidden.bs.modal', function(){

		//Cliente
		$('#nome_cliente').val("");
		$('#email_cliente').val("");
		$('#endereco').val("");
		$('#senha_cliente').val("");
		
		//Pizza
		$('#nome_pizza').val("");
		$('#descricao_pizza').val("");
		$('#preco_pizza').val("");

		//Bebida
		$('#nome_bebida').val('');
		$('#descricao_bebida').val("");
		$('#preco_bebida').val("");

		//funcionario
		$('#nome_funcionario').val("");
		$('#email_funcionario').val("");
		$('#salario').val("");
		$('#senha_funcionario').val("");



		$('input[name=id]').val(0);
	})



	$('.alterar_cliente').click(alterarDadosCliente);
	$('.alterar_pizza').click(alterarDadosPizza);
	$('.alterar_bebida').click(alterarDadosBebida);
	$('.alterar_funcionario').click(alterarDadosFuncionario);
})