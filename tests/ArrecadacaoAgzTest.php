<?php

require_once("./src/SegmentoAgz.php");
require_once("./src/ArrecadacaoAgz.php");
use PHPUnit\Framework\TestCase;

class ArrecadacaoAgzTest extends TestCase{
    public function testCriarArrecadacao(){
        $arrecadacao = new ArrecadacaoAgz(1);
        $this->assertEquals($arrecadacao->getRegistro(), 'G                                                                                                                                                     ');
    }
    public function testAdicionarSegmentosArrecadacaoForaDeOrdem(){
        $arrecadacao = new ArrecadacaoAgz();
        $segmento = new SegmentoAgz(3, 1, "8", SegmentoAgz::NUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(2, 1, "9", SegmentoAgz::NUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(7, 1, "7", SegmentoAgz::NUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(5, 2, "A", SegmentoAgz::ALFANUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $this->assertEquals($arrecadacao->getRegistro(), 'G98 A 7                                                                                                                                               ');
    }
    public function testMontarArrecadacaoFebraban(){
        $arrecadacao = new ArrecadacaoAgz();
        $segmento = new SegmentoAgz(2, 20, "18732 324183", SegmentoAgz::ALFANUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(22, 8, "20200730", SegmentoAgz::ALFANUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(30, 8, "20200801", SegmentoAgz::ALFANUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(38, 44, "82650000002235005340000202008200252601478104", SegmentoAgz::NUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(82, 12, "2235", SegmentoAgz::NUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(94, 7, "75", SegmentoAgz::NUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(101, 8, "1", SegmentoAgz::NUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(109, 8, "CF1415", SegmentoAgz::ALFANUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(117, 1, "1", SegmentoAgz::ALFANUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(118, 23, "555023", SegmentoAgz::ALFANUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(141, 1, "4", SegmentoAgz::NUMERICO);
        $arrecadacao->adicionarSegmento($segmento);
        $this->assertEquals($arrecadacao->getRegistro(), 'G18732 324183        202007302020080182650000002235005340000202008200252601478104000000002235000007500000001CF1415  1555023                 4         ');
    }
}
