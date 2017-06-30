<?php 

class UsuarioDao extends BaseDao{

	public function __construct(){
       parent::__construct("usuario");
    }

	public function cadastrar(Usuario $usuario){
		
		$dados = array();

		$querySelect = "SELECT email, login FROM {$this->tabela} WHERE email = ? OR login = ?";
		$stmt = $this->conexao->prepare($querySelect);
		$stmt->bindValue(1, $usuario->getEmail());
		$stmt->bindValue(2, $usuario->getLogin());

		$resultadoSelect = $stmt->execute();

		if($stmt->rowCount() > 0){	

			$retorno = $stmt->fetch(PDO::FETCH_ASSOC);
			$dados['status'] = 'erro';

			if($usuario->getEmail() == $retorno["email"]){				
				$dados['mensagem'] = 'Email já cadastrado';				
			} else if($usuario->getLogin() == $retorno["login"]){				
				$dados['mensagem'] = 'Login já cadastrado';				
			} else {				
				$dados['mensagem'] = 'Não foi possível efetuar o cadastro!';				
			}

			return $dados;
		} else {	

			$query = "INSERT INTO {$this->tabela} (email, login, senha, status, data_cadastro) VALUES (?, ?, ?, ?, ?)";
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1, $usuario->getEmail());
			$stmt->bindValue(2, $usuario->getLogin());
			$stmt->bindValue(3, $usuario->getSenha());
			$stmt->bindValue(4, $usuario->getStatus());
			$stmt->bindValue(5, $usuario->getDataCadastro());

			$resultado = $stmt->execute();
			$idusuario = $this->conexao->lastInsertId();

			if($resultado){
				$dados['status'] = 'sucesso';
				$dados['idusuario'] = $idusuario;
				$dados['mensagem'] = 'Cadastrado com sucesso';
			} else {				
				$dados['status'] = 'erro';
				$dados['mensagem'] = 'Não foi possível efetuar o cadastro!';
			}
			return $dados;
		}			
	}

	public function ativar($idusuario){
		
		$dados = array();

		$query = "UPDATE {$this->tabela} SET status = 1 WHERE id = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $idusuario);

		$resultado = $stmt->execute();

		if($resultado){
			$dados['status'] = 'sucesso';			
			$dados['mensagem'] = 'Usuário ativado com sucesso';			
		} else {				
			$dados['status'] = 'erro';
			$dados['mensagem'] = 'Não foi possível ativar o usuário!';
		}
		return $dados;
	}
	
}