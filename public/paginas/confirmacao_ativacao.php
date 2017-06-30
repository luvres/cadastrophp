<!DOCTYPE html>
<html lang="pt-br">
   <head>
       <title>Ativação de Cadastro</title>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width">
       <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
       <link rel="stylesheet" href="public/assets/css/estilo.css">       
   </head>
   <body>   		
   		<div class="container">
   			<div class="jumbotron">
   				<?php if(isset($mensagem)){ ?>
              <h2><?php echo $mensagem;?></h2>
          <?php } ?>
   			</div>
   		</div>
   </body>
</html>