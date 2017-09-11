<?php

namespace FrankBruno\GeradorCombinacoes;

/**
 * Class Gerador
 * @package FrankBruno\GeradorCombinacoes
 */
class Gerador
{
    /**
     * @var Modelo
     */
    private $modelo;

    /**
     * Gerador constructor.
     * @param Modelo $modelo
     */
    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }

    public function gerar()
    {
        return '';
    }
}