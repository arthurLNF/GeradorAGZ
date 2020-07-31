# Gerador Arquivos Febraban AGZ - “Layout” Padrão de Arrecadação/Recebimento com Utilização do Código de Barras

Note: This repository is in portuguese because AGZ files are used most commonly in Brazil. The whole code documentation is in portuguese and can be found in the directory 'docs'.

Implementação da geração de arquivos Febraban AGZ feita com o intuito de simplificar esta tarefa. Com ela é possível apenas informar o conteúdo dos campos para uma instância da classe ArquivoAgzPadrao e ela cuida da formatação e geração do arquivo. É possível também herdar a classe abstrata AquivoAgz para criar versões personalizadas deste tipo de arquivo, sem se preocupar com espaçamento e outras questões relacionadas à formatação.

* A documentação gerada com PHPDoc está no diretório \docs.
* O código fonte fica no diretório \src.
* Os testes unitários ficam no diretório \tests.
