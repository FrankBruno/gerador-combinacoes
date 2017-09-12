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
    private $inicio;

    /**
     * @var int
     */
    private $fim;

    /**
     * @var int
     */
    private $agrupamento;

    /**
     * Modelo constructor.
     * @param int $inicio
     * @param int $fim
     * @param int $agrupamento
     */
    public function __construct($inicio, $fim, $agrupamento)
    {
        $this->inicio = $inicio;
        $this->fim = $fim;
        $this->agrupamento = $agrupamento;
    }

    /**
     * @return int
     */
    public function getInicio(): int
    {
        return $this->inicio;
    }

    /**
     * @return int
     */
    public function getFim(): int
    {
        return $this->fim;
    }

    /**
     * @return int
     */
    public function getAgrupamento(): int
    {
        return $this->agrupamento;
    }
}