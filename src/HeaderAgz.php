<?php

require_once("RegistroAgz.php");

/**
 * class HeaderAgz
 * 
 * Parametriza registros do tipo A.
 */
class HeaderAgz extends RegistroAgz{
    /**
     * Construtor.
     * 
     * Inicializa o registro com o caractere 'A'.
     * 
     * @throws Exception
     * 
     * @param int $linha
     */
    public function __construct(){
        parent::__construct();
        $this->registro .= "A";
    } 

}
