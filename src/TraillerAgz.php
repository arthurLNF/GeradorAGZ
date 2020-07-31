<?php

require_once("RegistroAgz.php");

class TraillerAgz extends RegistroAgz{
    /**
     * Construtor.
     * 
     *Inicializa o registro com o caractere 'Z'.
     * 
     * @throws Exception
     * 
     *     */
    public function __construct(){
        parent::__construct();
        $this->registro .= "Z";
    } 

}
