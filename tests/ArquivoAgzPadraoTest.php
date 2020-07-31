<?php

require_once("./src/ArquivoAgzPadrao.php");

use PHPUnit\Framework\TestCase;

class ArquivoAgzPadraoTest extends TestCase
{
    public function testMontarHeaderComSucesso()
    {
        $arquivoAgz = new ArquivoAgzPadrao("/");
        $arquivoAgz->montarHeader(9, "141415", "AEGEA AGUAS GUARIROBA", 989, "CONTAFACIL", "20200730", 1, 6);
        $this->assertEquals($arquivoAgz->getHeader()->getRegistro(), 'A9141415              AEGEA AGUAS GUARIROB989CONTAFACIL          2020073000000106CÓDIGO DE BARRAS                                                     ');
    }

    public function testAdicionarArrecadacaoComSucesso()
    {
        $arquivoAgz = new ArquivoAgzPadrao("/");
        $arquivoAgz->adicionarArrecadacao("18732 324183", "20200730", "20200801", "82650000002235005340000202008200252601478104", 2235, 75, 1, "CF1415", 1, "555023", 4);
        $this->assertEquals($arquivoAgz->getArrecadacao()[0]->getRegistro(), 'G18732 324183        202007302020080182650000002235005340000202008200252601478104000000002235000007500000001CF1415  1555023                 4         ');
    }

    public function testMontarTraillerComSucesso()
    {
        $arquivoAgz = new ArquivoAgzPadrao("/");
        $arquivoAgz->montarTrailler(3, 2235);
        $this->assertEquals($arquivoAgz->getTrailler()->getRegistro(), 'Z00000300000000000002235                                                                                                                              ');
    }

    public function testSalvarArquivoComSucesso()
    {
        $arquivoAgz = new ArquivoAgzPadrao("output/agzteste.txt");
        $arquivoAgz->montarHeader(9, "141415", "AEGEA AGUAS GUARIROBA", 989, "CONTAFACIL", "20200730", 1, 6);
        $arquivoAgz->adicionarArrecadacao("18732 324183", "20200730", "20200801", "82650000002235005340000202008200252601478104", 2235, 75, 1, "CF1415", 1, "555023", 4);
        $arquivoAgz->montarTrailler(3, 2235);
        $this->assertEquals(
            $arquivoAgz->salvar(),
            'A9141415              AEGEA AGUAS GUARIROB989CONTAFACIL          2020073000000106CÓDIGO DE BARRAS                                                     ' . "\r\n" .
            'G18732 324183        202007302020080182650000002235005340000202008200252601478104000000002235000007500000001CF1415  1555023                 4         ' . "\r\n" .
            'Z00000300000000000002235                                                                                                                              '
        );
    }

    public function testSalvarArquivoSemHeaderDeveLancarException(){
        $this->expectExceptionMessage("O header não pode ser nulo.");
        $arquivoAgz = new ArquivoAgzPadrao("output/agzteste.txt");
        $arquivoAgz->adicionarArrecadacao("18732 324183", "20200730", "20200801", "82650000002235005340000202008200252601478104", 2235, 75, 1, "CF1415", 1, "555023", 4);
        $arquivoAgz->montarTrailler(3, 2235);
        $arquivoAgz->salvar();
    }

    public function testSalvarArquivoSemArrecadacaoDeveLancarException(){
        $this->expectExceptionMessage("Pelo menos um registro de arrecadação deve ser informado.");
        $arquivoAgz = new ArquivoAgzPadrao("output/agzteste.txt");
        $arquivoAgz->montarHeader(9, "141415", "AEGEA AGUAS GUARIROBA", 989, "CONTAFACIL", "20200730", 1, 6);
        $arquivoAgz->montarTrailler(3, 2235);
        $arquivoAgz->salvar();
    }
    
    public function testSalvarArquivoSemTraillerDeveLancarException(){
        $this->expectExceptionMessage("O trailler não pode ser nulo.");
        $arquivoAgz = new ArquivoAgzPadrao("output/agzteste.txt");
        $arquivoAgz->montarHeader(9, "141415", "AEGEA AGUAS GUARIROBA", 989, "CONTAFACIL", "20200730", 1, 6);
        $arquivoAgz->adicionarArrecadacao("18732 324183", "20200730", "20200801", "82650000002235005340000202008200252601478104", 2235, 75, 1, "CF1415", 1, "555023", 4);
        $arquivoAgz->salvar();
    }

}
