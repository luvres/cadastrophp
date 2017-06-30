<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>       
	<title>Exemplo - Cadastro de usuário</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/assets/css/estilo.css">       
</head>
<body>   		
	<div class="container">
		<div class="formulario">			
			<form id="cadastro" action="cadastro.php" method="post">
				<fieldset>
					<legend>Cadastro de usuário</legend>	       					
					<div class="form-group">
						<label>Email</label>
						<input id="email" type="email"  class="form-control" name="email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ;?>" required>
					</div>
					<div class="form-group">
						<label>Login</label>
						<input id="login" type="text" class="form-control" name="login" value="<?php echo (isset($_SESSION['login'])) ? $_SESSION['login'] : '' ;?>" required>
					</div>
					<div class="form-group">
						<label>Senha</label>
						<input id="senha" type="password" class="form-control" name="senha" required>
					</div>
					<div class="form-group align-right">
						<button id="cadastrar" type="submit" name="cadastrar" class="btn btn-primary btn-block">Cadastrar</button>
					</div>
				</fieldset>
			</form>
			<?php if(isset($_SESSION['mensagem'])){ ?>
				<div class="alert alert-danger">
					<?php echo $_SESSION['mensagem']; ?>
				</div>
			<?php }	?>
		</div>     		
	</div>
	<script src="public/assets/js/jquery-3.2.1.min.js"></script> 
	<script src="public/assets/js/script.js"></script>
</body>  
</html>
<?php session_destroy(); ?>