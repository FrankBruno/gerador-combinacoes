<?php

namespace FrankBruno\GeradorCombinacoes;

/**
 * Class ModeloFactory
 * @package FrankBruno\GeradorCombinacoes
 */
class ModeloFactory
{
    /**
     * @param int $inicio
     * @param int $fim
     * @param int $agrupamento
     * @return Modelo
     */
    public static function criar($inicio, $fim, $agrupamento)
    {
        return new Modelo($inicio, $fim, $agrupamento);
    }
}