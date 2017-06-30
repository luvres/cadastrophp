<?php

class Conexao {
    private static $dbtype = "pgsql";
    private static $host = "postgres-host";
    private static $usuario = "postgres";
    private static $senha = "postgres";
    private static $banco = "db_usuarios";
    private static $conexao = null;

    public static function getConexao(){
        if(empty($conexao)){
            self::$conexao = new PDO(self::$dbtype.":host=".self::$host.";dbname=".self::$banco, self::$usuario, self::$senha);
        }
        return self::$conexao;
    }
}
