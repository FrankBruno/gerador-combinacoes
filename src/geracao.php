<?php

$modelo = \FrankBruno\GeradorCombinacoes\ModeloFactory::criar(4, 2);
$gerador =  new \FrankBruno\GeradorCombinacoes\Gerador($modelo);

echo $gerador->gerar();
