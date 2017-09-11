<?php

require_once __DIR__ . '/Gerador.php';
require_once __DIR__ . '/Modelo.php';
require_once __DIR__ . '/ModeloFactory.php';

$incio = 1;
$fim = 5;
$agrupador = 2;

$modelo = \FrankBruno\GeradorCombinacoes\ModeloFactory::criar($incio, $fim, $agrupador);
$gerador = new \FrankBruno\GeradorCombinacoes\Gerador($modelo);

echo $gerador->gerarConteudo();
