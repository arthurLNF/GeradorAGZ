<?php

require_once("ArquivoAgz.php");

/**
 * class ArquivoAgzPadrao
 * 
 * Contém métodos para geração de um arquivo Febraban AGZ padrão em um caminho especificado.
 */
class ArquivoAgzPadrao extends ArquivoAgz
{

    /**
     * Construtor.
     * 
     * @param string $caminhoDoArquivo
     */
    public function __construct(string $caminhoDoArquivo)
    {
        parent::__construct($caminhoDoArquivo);
    }

    /**
     * Monta o header de um arquivo.
     * 
     * @param int $codigoDeRemessa
     * @param string $codigoDoConvenio
     * @param string $nomeDaEmpresa
     * @param int $codigoDoBanco
     * @param string $nomeDoBanco
     * @param int $dataDaGeracao
     * @param int $nsa
     * @param int $versaoDoLayout
     * 
     * @return void
     */
    public function montarHeader(int $codigoDeRemessa, string $codigoDoConvenio, string $nomeDaEmpresa, int $codigoDoBanco, string $nomeDoBanco, int $dataDaGeracao, int $nsa, int $versaoDoLayout)
    {
        $this->header = new HeaderAgz();
        $this->header->adicionarSegmento(new SegmentoAgz(2, 1, $codigoDeRemessa, SegmentoAgz::NUMERICO))
            ->adicionarSegmento(new SegmentoAgz(3, 20, $codigoDoConvenio, SegmentoAgz::ALFANUMERICO))
            ->adicionarSegmento(new SegmentoAgz(23, 20, $nomeDaEmpresa, SegmentoAgz::ALFANUMERICO))
            ->adicionarSegmento(new SegmentoAgz(43, 3, $codigoDoBanco, SegmentoAgz::NUMERICO))
            ->adicionarSegmento(new SegmentoAgz(46, 20, $nomeDoBanco, SegmentoAgz::ALFANUMERICO))
            ->adicionarSegmento(new SegmentoAgz(66, 8, $dataDaGeracao, SegmentoAgz::NUMERICO))
            ->adicionarSegmento(new SegmentoAgz(74, 6, $nsa, SegmentoAgz::NUMERICO))
            ->adicionarSegmento(new SegmentoAgz(80, 2, $versaoDoLayout, SegmentoAgz::NUMERICO))
            ->adicionarSegmento(new SegmentoAgz(82, 17, "CÓDIGO DE BARRAS", SegmentoAgz::ALFANUMERICO));
    }

    /**
     * Adiciona um registro de arrecadação a um arquivo.
     * 
     * @param string $dadosBancarios
     * @param string $dataDePagamento
     * @param string $dataDeCredito
     * @param string $codigoDeBarras
     * @param int $valorRecebido
     * @param int $valorDaTarifa
     * @param int $nsr
     * @param string $codigoDoArrecadador
     * @param string $formaDeArrecadacao
     * @param string $numeroDeAutenticacao
     * @param int $formaDePagamento
     * 
     * @return void
     */
    public function adicionarArrecadacao(string $dadosBancarios, string $dataDePagamento, string $dataDeCredito, string $codigoDeBarras, int $valorRecebido, int $valorDaTarifa, int $nsr, string $codigoDoArrecadador, string $formaDeArrecadacao, string $numeroDeAutenticacao, int $formaDePagamento){
        $arrecadacao = new ArrecadacaoAgz();
        $arrecadacao->adicionarSegmento(new SegmentoAgz(2, 20, $dadosBancarios, SegmentoAgz::ALFANUMERICO))
            ->adicionarSegmento(new SegmentoAgz(22, 8, $dataDePagamento, SegmentoAgz::ALFANUMERICO))
            ->adicionarSegmento(new SegmentoAgz(30, 8, $dataDeCredito, SegmentoAgz::ALFANUMERICO))
            ->adicionarSegmento(new SegmentoAgz(38, 44, $codigoDeBarras, SegmentoAgz::ALFANUMERICO))
            ->adicionarSegmento(new SegmentoAgz(82, 12, $valorRecebido, SegmentoAgz::NUMERICO))
            ->adicionarSegmento(new SegmentoAgz(94, 7, $valorDaTarifa, SegmentoAgz::NUMERICO))
            ->adicionarSegmento(new SegmentoAgz(101, 8, $nsr, SegmentoAgz::NUMERICO))
            ->adicionarSegmento(new SegmentoAgz(109, 8, $codigoDoArrecadador, SegmentoAgz::ALFANUMERICO))
            ->adicionarSegmento(new SegmentoAgz(117, 1, $formaDeArrecadacao, SegmentoAgz::ALFANUMERICO))
            ->adicionarSegmento(new SegmentoAgz(118, 23, $numeroDeAutenticacao, SegmentoAgz::ALFANUMERICO))
            ->adicionarSegmento(new SegmentoAgz(141, 1, $formaDePagamento, SegmentoAgz::NUMERICO));
        $this->arrecadacao[] = $arrecadacao;
    }

    /**
     * Monta o trailler de um arquivo.
     * 
     * @param int $totalDeRegistros
     * @param int $valorTotal
     * 
     * @return void
     */
    public function montarTrailler(int $totalDeRegistros, int $valorTotal){
        $this->trailler = new TraillerAgz();
        $this->trailler->adicionarSegmento(new SegmentoAgz(2, 6, $totalDeRegistros, SegmentoAgz::NUMERICO))
            ->adicionarSegmento(new SegmentoAgz(8, 17, $valorTotal, SegmentoAgz::NUMERICO));
    }

}
