<?php
class Conexao {
    private static $host = "mariadb-host";
    private static $usuario = "root";
    private static $senha = "maria";        
    private static $banco = "db_usuarios";
    private static $conexao = null;

    public static function getConexao(){
        if(empty($conexao)){
            self::$conexao = new PDO("mysql:host=".self::$host.";dbname=".self::$banco, self::$usuario, self::$senha);
        }

        return self::$conexao;
    }
}
