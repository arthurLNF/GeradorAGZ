<?php

require_once("RegistroAgz.php");

class ArrecadacaoAgz extends RegistroAgz{
    /**
     * Construtor.
     * 
     * Inicializa o registro com o caractere 'G'.
     * 
     * @throws Exception
     * 
     * @param int $linha
     */
    public function __construct(){
        parent::__construct();
        $this->registro .= "G";
    } 

}
