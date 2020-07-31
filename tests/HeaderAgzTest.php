<?php

require_once("./src/SegmentoAgz.php");
require_once("./src/HeaderAgz.php");
use PHPUnit\Framework\TestCase;

class HeaderAgzTest extends TestCase{
    public function testCriarHeader(){
        $header = new HeaderAgz(1);
        $this->assertEquals($header->getRegistro(), 'A                                                                                                                                                     ');
    }
    public function testCriarHeaderComLinhaZeroDeveLancarException(){
        $this->expectExceptionMessage("A linha deve ser maior que zero.");
        $header = new HeaderAgz(0);
    }
    public function testAdicionarSegmentosAoHeaderForaDeOrdem(){
        $header = new HeaderAgz(1);
        $segmento = new SegmentoAgz(3, 1, "8", SegmentoAgz::NUMERICO);
        $header->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(2, 1, "9", SegmentoAgz::NUMERICO);
        $header->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(7, 1, "7", SegmentoAgz::NUMERICO);
        $header->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(5, 2, "A", SegmentoAgz::ALFANUMERICO);
        $header->adicionarSegmento($segmento);
        $this->assertEquals($header->getRegistro(), 'A98 A 7                                                                                                                                               ');
    }
    public function testMontarHeaderFebraban(){
        $header = new HeaderAgz(1);
        $segmento = new SegmentoAgz(2, 1, "9", SegmentoAgz::NUMERICO);
        $header->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(3, 20, "141415", SegmentoAgz::ALFANUMERICO);
        $header->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(23, 20, "AEGEA AGUAS GUARIROBA", SegmentoAgz::ALFANUMERICO);
        $header->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(43, 3, "989", SegmentoAgz::NUMERICO);
        $header->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(46, 20, "CONTAFACIL", SegmentoAgz::ALFANUMERICO);
        $header->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(66, 8, "20200730", SegmentoAgz::NUMERICO);
        $header->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(74, 6, "000001", SegmentoAgz::NUMERICO);
        $header->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(80, 2, "6", SegmentoAgz::NUMERICO);
        $header->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(82, 17, "CÓDIGO DE BARRAS", SegmentoAgz::ALFANUMERICO);
        $header->adicionarSegmento($segmento);
        $this->assertEquals($header->getRegistro(), 'A9141415              AEGEA AGUAS GUARIROB989CONTAFACIL          2020073000000106CÓDIGO DE BARRAS                                                     ');
    }
}
