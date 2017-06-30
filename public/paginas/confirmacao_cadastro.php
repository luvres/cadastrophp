<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
       <title>Confirmação de cadastro</title>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width">
       <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
       <link rel="stylesheet" href="public/assets/css/estilo.css">  
   </head>
   <body>   		
   		<div class="container">
   			<div class="jumbotron">
   				<h2>Cadastro feito com sucesso!</h2>
   				<p>Enviamos um link para o seu email para a ativação do cadastro.</p>				  
   			</div>
   		</div>     
   </body>
</html>
<?php session_destroy(); ?>