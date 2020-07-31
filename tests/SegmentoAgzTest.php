<?php

require_once("./src/SegmentoAgz.php");
use PHPUnit\Framework\TestCase;

class SegmentoAgzTest extends TestCase{
    public function testCriarSegmentoAlfanumericoValidoComTamanhoIgualAoDoConteudoInformado(){
        $segmento = new SegmentoAgz(2, 10, "CONTAFACIL", SegmentoAgz::ALFANUMERICO);
        $this->assertEquals($segmento->getConteudo(), "CONTAFACIL");
    }
    public function testCriarSegmentoAlfanumericoValidoComTamanhoMenorAoDoConteudoInformado(){
        $segmento = new SegmentoAgz(2, 8, "CONTAFACIL", SegmentoAgz::ALFANUMERICO);
        $this->assertEquals($segmento->getConteudo(), "CONTAFAC");
    }
    public function testCriarSegmentoAlfanumericoValidoComTamanhoMaiorAoDoConteudoInformado(){
        $segmento = new SegmentoAgz(2, 12, "CONTAFACIL", SegmentoAgz::ALFANUMERICO);
        $this->assertEquals($segmento->getConteudo(), "CONTAFACIL  ");
    }

    public function testCriarSegmentoNumericoValidoComTamanhoIgualAoDoConteudoInformado(){
        $segmento = new SegmentoAgz(2, 3, "989", SegmentoAgz::NUMERICO);
        $this->assertEquals($segmento->getConteudo(), "989");
    }
    public function testCriarSegmentoNumericoValidoComTamanhoMenorAoDoConteudoInformado(){
        $segmento = new SegmentoAgz(2, 2, "989", SegmentoAgz::NUMERICO);
        $this->assertEquals($segmento->getConteudo(), "98");
    }
    public function testCriarSegmentoNumericoValidoComTamanhoMaiorAoDoConteudoInformado(){
        $segmento = new SegmentoAgz(2, 6, "989", SegmentoAgz::NUMERICO);
        $this->assertEquals($segmento->getConteudo(), "000989");
    }

    public function testSegmentoComPosicaoInicialZeroDeveLancarException(){
        $this->expectExceptionMessage("A posição 1 é reservada para o tipo de registro.");
        $segmento = new SegmentoAgz(1, 3, "989", SegmentoAgz::NUMERICO);        
    }
    public function testSegmentoComPosicaoInicialMenorQueZeroDeveLancarException(){
        $this->expectExceptionMessage("A posição inicial deve ser maior que um.");
        $segmento = new SegmentoAgz(-1, 3, "989", SegmentoAgz::NUMERICO);        
    }
    public function testSegmentoComTamanhoZeroDeveLancarException(){
        $this->expectExceptionMessage("O tamanho deve maior que zero.");
        $segmento = new SegmentoAgz(2, 0, "989", SegmentoAgz::NUMERICO);        
    }
}
