<?php
spl_autoload_register(function ($class) {
	$entidadesDir = __DIR__ . '/entidades/';
	$daoDir = __DIR__ . '/dao/';
	$validaDir = __DIR__ . '/validacao/';

	$arquivoEntidades = $entidadesDir . str_replace('\\', '/', lcfirst($class)) . '.php';
	$arquivoDao = $daoDir . str_replace('\\', '/', lcfirst($class)) . '.php';	
	$arquivoValida = $validaDir . str_replace('\\', '/', lcfirst($class)) . '.php';

	if (file_exists($arquivoEntidades)){
		require $arquivoEntidades;
	} else if(file_exists($arquivoDao)){
		require $arquivoDao;
	} else if(file_exists($arquivoValida)){
		require $arquivoValida;
	}
});