<?php

require_once("./src/SegmentoAgz.php");
require_once("./src/TraillerAgz.php");
use PHPUnit\Framework\TestCase;

class TraillerAgzTest extends TestCase{
    public function testCriarTrailler(){
        $trailler = new TraillerAgz();
        $this->assertEquals($trailler->getRegistro(), 'Z                                                                                                                                                     ');
    }
    public function testAdicionarSegmentosAoTraillerForaDeOrdem(){
        $trailler = new TraillerAgz();
        $segmento = new SegmentoAgz(3, 1, "8", SegmentoAgz::NUMERICO);
        $trailler->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(2, 1, "9", SegmentoAgz::NUMERICO);
        $trailler->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(7, 1, "7", SegmentoAgz::NUMERICO);
        $trailler->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(5, 2, "A", SegmentoAgz::ALFANUMERICO);
        $trailler->adicionarSegmento($segmento);
        $this->assertEquals($trailler->getRegistro(), 'Z98 A 7                                                                                                                                               ');
    }
    public function testMontarTraillerFebraban(){
        $trailler = new TraillerAgz();
        $segmento = new SegmentoAgz(2, 6, "3", SegmentoAgz::NUMERICO);
        $trailler->adicionarSegmento($segmento);
        $segmento = new SegmentoAgz(8, 17, "2235", SegmentoAgz::NUMERICO);
        $trailler->adicionarSegmento($segmento);
        $this->assertEquals($trailler->getRegistro(), 'Z00000300000000000002235                                                                                                                              ');
    }
}
