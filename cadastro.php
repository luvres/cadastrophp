<?php
	session_start();
	require_once ('autoload.php');
	require_once ('vendor/mailer/PHPMailerAutoload.php');

	$email = trim($_POST['email']);
	$login = trim($_POST['login']);
	$senha = trim($_POST['senha']);

	date_default_timezone_set('America/Sao_Paulo');
	$dataCadastro = date("Y-m-d H:i:s");

	$usuario = new Usuario();
	$usuario->setEmail($email);
	$usuario->setLogin($login);
	$usuario->setSenha(sha1($senha));
	$usuario->setStatus(0);
	$usuario->setDataCadastro($dataCadastro);

	$usuarioValida = new UsuarioValida();

	$mensagem = $usuarioValida->validar($usuario);

	if(!empty($mensagem)){
		$_SESSION['mensagem'] = $mensagem;
		header('Location: http://'.$_SERVER["HTTP_HOST"].'/');
	} else {

	$usuarioDao = new UsuarioDao();

	$resultado = $usuarioDao->cadastrar($usuario);

	if($resultado['status'] == 'sucesso'){
		$idusuario = $resultado['idusuario'];
		$codigohash = sha1($usuario->getEmail());

		$mail = new PHPMailer();

		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->CharSet = 'UTF-8';
		$mail->Username = '1uvr3z@gmail.com';
		$mail->Password = '';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->setFrom('1uvr3z@gmail.com', 'Confirmação de cadastro');
		$mail->addAddress($usuario->getEmail(), 'Usuario');
		$mail->isHTML(true);

		$url = "http://".$_SERVER["HTTP_HOST"]."/confirmacao_ativacao.php?ativa=".$codigohash;
		$mail->Subject = 'Link de ativação do cadastro';
		$mail->Body    = 'Olá '.$usuario->getLogin().', para ativar seu cadastro clique no link abaixo: <br><br>';
		$mail->Body    .= '<a href="'.$url.'">Ativar Cadastro</a>';

		if($mail->send()){

			$hash = new Hash();
			$hash->setHash($codigohash);
			$hash->setStatus(0);
			$hash->setDataCadastro($dataCadastro);
			$hash->setIdUsuario($idusuario);

			$hashDao = new hashDao();
			$resultadoHash = $hashDao->cadastrar($hash);

			if($resultadoHash['status'] == 'sucesso'){
				header('Location: http://'.$_SERVER["HTTP_HOST"].'/confirmacao_cadastro.php');
			} else {
				$_SESSION['mensagem'] = $resultadoHash['mensagem'];
				header('Location: http://'.$_SERVER["HTTP_HOST"].'/');
			}
		} else {
			$mensagem = 'Erro no envio de email!';
			$_SESSION['mensagem'] = $mensagem;
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/');
		}
	} else {
		$_SESSION['mensagem'] = $resultado['mensagem'];
		header('Location: http://'.$_SERVER["HTTP_HOST"].'/');
	}
}
