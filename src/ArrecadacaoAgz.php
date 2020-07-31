<?php

require_once("RegistroAgz.php");

class ArrecadacaoAgz extends RegistroAgz{
    /**
     * Construtor.
     * 
     * Recebe a linha do arquivo em que o registro será impresso e inicializa o registro com o caractere 'G'.
     * 
     * @throws Exception
     * 
     * @param int $linha
     */
    public function __construct(int $linha){
        parent::__construct($linha);
        $this->registro .= "G";
    } 

}
