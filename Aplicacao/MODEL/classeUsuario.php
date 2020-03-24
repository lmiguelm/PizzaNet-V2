<?php

	class Usuario{
	
		private $id;
		private $nome;
		private $email;
		private $senha;
		private $permissao;
		private $endereco;
		private $salario;
		
		public function __construct($parametros){
			if(isset($parametros["id_cliente"])){
				$this->id = $parametros["id_cliente"];
			}
			if(isset($parametros["id_funcionario"])){
				$this->id = $parametros["id_funcionario"];
			}
			if(isset($parametros["endereco"])){
				$this->endereco = $parametros["endereco"];
			}
			if(isset($parametros["salario"])){
				$this->salario = $parametros["salario"];
			}
			$this->nome = $parametros["nome"];
			$this->email = $parametros["email"];
			$this->senha = $parametros["senha"];
			$this->permissao = $parametros["permissao"];			
		}
		
		public function get_nome(){
			return($this->nome);
		}
		public function get_permissao(){
			return($this->permissao);
		}
		public function get_id(){
			return($this->id);
		}
		public function get_email(){
			return($this->email);
		}
	}
?>