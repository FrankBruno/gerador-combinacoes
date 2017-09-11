<?php

namespace FrankBruno\GeradorCombinacoes;

/**
 * Class Modelo
 * @package FrankBruno\GeradorCombinacoes
 */
class Modelo
{
    /**
     * @var int
     */
    private $quantidade;

    /**
     * @var int
     */
    private $agrupamento;

    /**
     * Modelo constructor.
     * @param int $quantidade
     * @param int $agrupamento
     */
    public function __construct($quantidade, $agrupamento)
    {
        $this->quantidade = $quantidade;
        $this->agrupamento = $agrupamento;
    }
}