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
     * @var
     */
    private $conteudo;

    /**
     * Gerador constructor.
     * @param Modelo $modelo
     */
    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * @return string
     */
    public function gerarConteudo()
    {
        return $this->gerar(
            $this->modelo->getInicio(),
            $this->modelo->getFim(),
            $this->modelo->getAgrupamento()
        );
    }

    /**
     * @param int $initValue
     * @param int $limitValue
     * @param int $recLimit
     * @param int $recIndex
     * @param array $acc
     * @return string
     */
    public function gerar($initValue, $limitValue, $recLimit = 0, $recIndex = 0, $acc = [])
    {
        for ($i = $initValue; $i <= $limitValue; $i++) {
            $newAcc = array_merge($acc, [$i]);
            if ($recIndex < $recLimit) {
                $this->gerar($i + 1, $limitValue, $recLimit, $recIndex + 1, $newAcc);
            } else {
                $this->conteudo .= implode(',', $newAcc) . "<br>";
            }
        }

        return $this->conteudo;
    }
}