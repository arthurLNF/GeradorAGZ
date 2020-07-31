<?php

require_once("HeaderAgz.php");
require_once("ArrecadacaoAgz.php");
require_once("TraillerAgz.php");

abstract class ArquivoAgz{
    /**
     * Header do arquivo.
     * @var HeaderAgz
     */
    protected $header;
    
    /**
     * Arrecadações do arquivo.
     * @var ArrecadacaoAgz[]
     */
    protected $arrecadacao;

    /**
     * Trailler do arquivo.
     * @var TraillerAgz
     */
    protected $trailler;

    /**
     * Caminho onde o arquivo deve ser armazenado.
     * @var string
     */
    protected $caminhoDoArquivo;

    /**
     * Construtor.
     * 
     * @param string $caminhoDoArquivo
     */
    public function __construct(string $caminhoDoArquivo){
        $this->caminhoDoArquivo = $caminhoDoArquivo;
        $this->arrecadacao = [];
    }

    /**
     * Set header do arquivo.
     *
     * @param  HeaderAgz  $header  Header do arquivo.
     *
     * @return  self
     */ 
    public function setHeader(HeaderAgz $header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Set arrecadações do arquivo.
     *
     * @param  ArrecadacaoAgz[]  $arrecadacao  Arrecadações do arquivo.
     *
     * @return  self
     */ 
    public function setArrecadacao(array $arrecadacao)
    {
        $this->arrecadacao = $arrecadacao;

        return $this;
    }

    /**
     * Set trailler do arquivo.
     *
     * @param  TraillerAgz  $trailler  Trailler do arquivo.
     *
     * @return  self
     */ 
    public function setTrailler(TraillerAgz $trailler)
    {
        $this->trailler = $trailler;

        return $this;
    }

    /**
     * Get header do arquivo.
     *
     * @return  HeaderAgz
     */ 
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Get arrecadações do arquivo.
     *
     * @return  ArrecadacaoAgz[]
     */ 
    public function getArrecadacao()
    {
        return $this->arrecadacao;
    }

    /**
     * Get trailler do arquivo.
     *
     * @return  TraillerAgz
     */ 
    public function getTrailler()
    {
        return $this->trailler;
    }

    /**
     * Salva um arquivo AGZ.
     * 
     * Este método monta o arquivo AGZ com o header, arrecadação e trailler informados.
     * Caso a geração automática de trailler esteja habilitada, o trailler é gerado com base no header e arrecadação, seguindo o layout Febraban Padrão.
     * 
     * @param string $quebraDeLinha
     * Usado para quebra de linhas do arquivo. Por padrão, é utilizado "\r\n".
     * 
     * @return void
     * 
     * @throws Exception
     */
    public function salvar(string $quebraDeLinha = "\r\n"){
        $this->validar();
        $conteudo = $this->header->getRegistro() . $quebraDeLinha;
        foreach($this->arrecadacao as $a){
            $conteudo .= $a->getRegistro() . $quebraDeLinha;
        }
        $conteudo .= $this->trailler->getRegistro();
        $arquivo = fopen($this->caminhoDoArquivo, 'w');
        if ($arquivo) {
            fwrite($arquivo, $conteudo);
            fclose($arquivo);
        }
        else{
            throw new Exception("Erro ao abrir o arquivo no caminho $this->caminhoDoArquivo");
        }
        return $conteudo;       
    }

    /**Valida o arquivo AGZ.
     * @return void
     * @throws Exception
     */
    private function validar(){
        if($this->header == NULL){
            throw new Exception("O header não pode ser nulo.");
        }
        if(count($this->arrecadacao) == 0){
            throw new Exception("Pelo menos um registro de arrecadação deve ser informado.");
        }
        if($this->trailler == NULL){
            throw new Exception("O trailler não pode ser nulo.");
        }
    }
}

?>