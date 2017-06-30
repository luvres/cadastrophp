<?php
require_once ('autoload.php');

if(!empty($_GET['ativa'])){	
	$hash = $_GET['ativa'];

	$hashDao = new HashDao();
	$dados = $hashDao->retornaHash($hash);

	if($dados['status'] == 'sucesso'){

		$hashValida = new HashValida();
		$expiracao = $hashValida->validar($dados['hash']['data_cadastro'], 3);

		if($expiracao['status'] == 'sucesso'){	
		
			$ativacaoHash = $hashDao->ativar($dados['hash']['id']);

			if($ativacaoHash['status'] == 'sucesso'){
				
				$usuarioDao = new UsuarioDao();				
				$ativacaoUsuario = $usuarioDao->ativar($dados['hash']['id_usuario']);
				
				$mensagem = $ativacaoUsuario['mensagem'];

			} else {
				$mensagem = $ativacaoHash['mensagem'];
			}
		} else {
			$mensagem = $expiracao['mensagem'];
		}					
	} else {
		$mensagem = $dados['mensagem'];
	}
} else {
	$mensagem = "Não foi verificada a chave de ativação";
}

require_once ('public/paginas/confirmacao_ativacao.php');
?>