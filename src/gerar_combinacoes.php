<?php
ini_set('memory_limit', '1G');
set_time_limit(0);

// Verifica argumentos
if ($argc < 5) {
    echo "Uso: php gerar_otimizado.php <inicio> <fim> <agrupamento> <nome_da_loteria>\n";
    exit(1);
}

$inicio = (int) $argv[1];
$fim = (int) $argv[2];
$agrupamento = (int) $argv[3];
$nome = $argv[4];

// Validação CRÍTICA de viabilidade
$n = $fim - $inicio + 1;
// Cálculo aproximado de combinações (para evitar travar em números astronômicos)
// Se for muito grande, avisa e para.
// Função simples para estimar C(n,k)
function estimarCombinacoes($n, $k)
{
    if ($k < 0 || $k > $n)
        return 0;
    if ($k == 0 || $k == $n)
        return 1;
    if ($k > $n / 2)
        $k = $n - $k;
    $res = 1;
    for ($i = 1; $i <= $k; $i++) {
        $res = $res * ($n - $i + 1) / $i;
        if ($res > 10000000000)
            return $res; // Retorna logo se for gigante (> 10 bi)
    }
    return $res;
}

$estimativa = estimarCombinacoes($n, $agrupamento);
if ($estimativa > 3500000000) { // Limite de sanidade (3.5 bilhões)
    echo "ERRO: A loteria '$nome' geraria mais de " . number_format($estimativa, 0, ',', '.') . " combinacoes.\n";
    echo "Isso é inviável computacionalmente para este script (excederia tempo/espaço disco).\n";
    echo "Para referência: Lotomania (100 combinados 50) é impossível (10^29 combinações).\n";
    exit(1);
}

$baseDir = __DIR__ . '/arquivos/' . $nome;

// Limpa/Recria diretório alvo
if (is_dir($baseDir)) {
    // Opcional: limpar arquivos antigos? Vamos apenas garantir que existe.
} else {
    if (!mkdir($baseDir, 0777, true)) {
        die("Erro ao criar diretório $baseDir\n");
    }
}

// Gerador de Combinações Otimizado
function getCombinations(array $base, int $k)
{
    $n = count($base);
    if ($k <= 0 || $k > $n)
        return;

    $indices = range(0, $k - 1);

    // Primeira combinação
    $first = [];
    foreach ($indices as $i)
        $first[] = $base[$i];
    yield $first;

    while (true) {
        $i = $k - 1;
        while ($i >= 0 && $indices[$i] == $n - $k + $i) {
            $i--;
        }
        if ($i < 0)
            break;

        $indices[$i]++;
        for ($j = $i + 1; $j < $k; $j++) {
            $indices[$j] = $indices[$j - 1] + 1;
        }

        $result = [];
        foreach ($indices as $idx)
            $result[] = $base[$idx];
        yield $result;
    }
}

$numeros = range($inicio, $fim);
$handles = []; // Cache de arquivos abertos: [soma => resource]

echo "Iniciando $nome ($inicio-$fim, agrupa $agrupamento)...\n";
$start = microtime(true);
$count = 0;

foreach (getCombinations($numeros, $agrupamento) as $comb) {
    // Calcula soma
    $soma = array_sum($comb);

    // Verifica se temos o arquivo aberto
    if (!isset($handles[$soma])) {
        // Tenta abrir. Se falhar (limite de arquivos do SO), fecha um pouco usados? 
        // Normalmente o range de somas não excede 1000 arquivos (limite padrão Linux/Win).
        // Se exceder, precisariamos de uma estratégia de LRU (Least Recently Used), mas vamos assumir que cabe.
        $path = $baseDir . '/' . $soma . '.txt';
        $h = fopen($path, 'a'); // Append mode
        if (!$h) {
            // Se falhar, pode ser limite de handles.
            // Fecha todos (flush) e reabre só este. (Estratégia drástica mas segura)
            foreach ($handles as $res)
                fclose($res);
            $handles = [];
            $h = fopen($path, 'a');
        }
        $handles[$soma] = $h;
    }

    fwrite($handles[$soma], implode(',', $comb) . PHP_EOL);

    $count++;
    if ($count % 100000 === 0) {
        echo "\rGeradas: " . number_format($count, 0, ',', '.');
    }
}

// Fecha tudo
foreach ($handles as $h)
    fclose($h);

$end = microtime(true);
$tempo = $end - $start;

echo "\nFinalizado $nome!\n";
echo "Total: " . number_format($count, 0, ',', '.') . " combinações.\n";
echo "Tempo: " . number_format($tempo, 2) . "s\n";
