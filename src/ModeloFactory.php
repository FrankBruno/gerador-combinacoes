<?php

namespace FrankBruno\GeradorCombinacoes;

/**
 * Class ModeloFactory
 * @package FrankBruno\GeradorCombinacoes
 */
class ModeloFactory
{
    /**
     * @param int $quantidade
     * @param int $agrupamento
     * @return Modelo
     */
    public static function criar($quantidade, $agrupamento)
    {
        return new Modelo($quantidade, $agrupamento);
    }
}