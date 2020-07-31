<?php

require_once("SegmentoAgz.php");

abstract class RegistroAgz{
    /**
     * @var SegmentoAgz[]
     */
    protected $segmentos;
    /**
     * Armazena o registro a ser impresso no arquivo.     *
     * @var string
     */
    protected $registro;

    /**
     * Construtor.
     * 
     * Recebe a linha do arquivo em que o registro será impresso e inicializa o array de registros.
     * 
     * @throws Exception
     * 
     * @param int $linha
     */
    public function __construct(){       
        $this->segmentos = [];
        $this->registro = "";
    }

    /**
     * Monta o registro a partir dos segmentos e o retorna.
     * 
     * Caso o registro seja menor que 150 posições, completa-o com brancos.
     * Caso o registro seja maior que 150 posições, retorna apenas as 150 primeiras.
     * @return string
     */
    public function getRegistro(){
        $this->ordenarSegmentos();
        foreach($this->segmentos as $s){
            $conteudo = $s->getConteudo();
            for($i = mb_strlen($this->registro, 'UTF-8'); $i < $s->getPosicaoInicial()-1; $i++){
                $this->registro .= " ";
            }
            $this->registro .= $s->getConteudo();
        }
        for($i = mb_strlen($this->registro, 'UTF-8'); $i < 150; $i++){
            $this->registro .= ' ';
        }
        $this->registro = mb_substr($this->registro, 0, 150, 'UTF-8');
        return $this->registro;
    }

    /**
     * Ordena os segmentos do registro pela posição inicial de forma crescente.
     * 
     * @return void
     */
    private function ordenarSegmentos(){
        usort($this->segmentos, function($a, $b){
            if($a->getPosicaoInicial() < $b->getPosicaoInicial()){
                return -1;
            } else if($a->getPosicaoInicial() == $b->getPosicaoInicial()){
                return 0;
            } else{
                return 1;
            }      
        });
    }

    /**
    * Adiciona um segmento ao registro.
    * 
    * @param SegmentoAgz $segmento
    * 
    * @return self
    */
    public function adicionarSegmento(SegmentoAgz $segmento){
        $this->segmentos[] = $segmento;
        return $this;
    }
}

?>