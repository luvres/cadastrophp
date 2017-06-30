<?php
require_once ('autoload.php');

abstract class BaseDao{
    protected $conexao;
    protected $tabela;    

    public function __construct($tabela){
        $this->tabela = $tabela;
        $this->conexao = Conexao::getConexao();        
    }
}