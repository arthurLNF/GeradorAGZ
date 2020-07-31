<?php

/**
 * Class SegmentoAgz
 * 
 * Cria e formata segmentos de registros dos arquivos AGZ.
 * 
 */
class SegmentoAgz {

    const NUMERICO = true;
    const ALFANUMERICO = false;

    /**
     * @var integer
     */
    private $posicaoInicial;
    /**
     * @var integer
     */
    private $tamanho;
    /**
     * @var string
     */
    private $conteudo;
    /**
     * @var boolean
     */
    private $numerico;

    /**
     * Construtor
     * 
     * Cria um segmento, formatando-o de acordo com o atributo "numerico".
     * A posição inicial deve ser maior que zero, sendo que a posição zero de um registro é reservada para o tipo dele.
     * O tamanho deve ser maior que zero.
     * Caso as condições acima não sejam respeitadas, exceções são lançadas.
     * 
     * @param int $posicaoInicial
     * @param int $tamanho
     * @param string $conteudo
     * @param bool $numerico
     * 
     * @throws Exception
     */
    public function __construct(int $posicaoInicial, int $tamanho, string $conteudo, bool $numerico = false){
        $this->posicaoInicial = $posicaoInicial;
        $this->tamanho = $tamanho;
        $this->conteudo = $conteudo;
        $this->numerico = $numerico;
        $this->validar();
        $this->formatarConteudo();
    }


    /**
     * Realiza a formatação do conteúdo
     * 
     * Caso o conteúdo seja maior que o tamamho especificado, trunca o conteúdo.
     * Caso seja menor que o tamanho e seja do tipo numérico, adiciona zeros à esquerda até atingir o tamanho especificado.
     * Caso seja menor que o tamanho e seja do tipo alfanumérico, adiciona brancos à direita até atingir o tamanho especificado.
     * 
     * @return void
     */
    private function formatarConteudo(){
        $conteudo = (string) $this->conteudo;
        if(mb_strlen($conteudo, 'UTF-8') > $this->tamanho){
            $conteudo = mb_substr($conteudo, 0, $this->tamanho, 'UTF-8');            
        }
        if(mb_strlen($conteudo, 'UTF-8') == $this->tamanho){
            $this->conteudo = $conteudo;
            return;
        }
        if($this->numerico){            
            for($i = mb_strlen($conteudo, 'UTF-8'); $i < $this->tamanho; $i++){
                $conteudo = '0' . $conteudo;                
            }
        } else{
            for($i = mb_strlen($conteudo, 'UTF-8'); $i < $this->tamanho; $i++){
                $conteudo .= ' ';
            }
        }
        $this->conteudo = $conteudo;
    }

    /**
     * Valida os atributos do segmento de acordo com o especificado na descrição do construtor.
     * 
     * @throws Exception
     * 
     * @return void
     */
    private function validar(){
        if($this->posicaoInicial == 1){
            throw new Exception("A posição 1 é reservada para o tipo de registro.");
        }
        if($this->posicaoInicial < 1){
            throw new Exception("A posição inicial deve ser maior que um.");
        }
        if($this->tamanho <= 0){
            throw new Exception("O tamanho deve maior que zero.");
        }
    }

    /**
     * Retorna o conteudo de um segmento.
     * 
     * @return string
     */
    public function getConteudo(){
        return $this->conteudo;
    }

    /**
     * Retorna a posição inicial de um segmento.
     * 
     * @return int
     */
    public function getPosicaoInicial(){
        return $this->posicaoInicial;
    }

    /**
     * Retorna o tamanho de um segmento.
     * 
     * @return int
     */
    public function getTamanho(){
        return $this->tamanho;
    }

    /**
     * Retorna o tipo de um segmento.
     * 
     * @return bool
     */
    public function getNumerico(){
        return $this->numerico;
    }

}

?>