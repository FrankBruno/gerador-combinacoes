# Gerador de Combinações de Loteria

Sistema simples em PHP para gerar combinações numéricas agrupadas.

## Requisitos

- PHP 7.4 ou superior instalado e configurado no PATH do sistema.

## Instalação

Apenas baixe os arquivos para uma pasta.

## Como Usar

Abra o terminal na pasta do projeto e execute o comando seguindo o padrão:

```bash
php gerar_combinacoes.php <inicio> <fim> <agrupamento> <nome_da_loteria>
```

### Parâmetros

1. **inicio**: O primeiro número do intervalo (ex: 1).
2. **fim**: O último número do intervalo (ex: 60).
3. **agrupamento**: Quantos números por combinação (ex: 6).
4. **nome_da_loteria**: Nome usado para gerar o arquivo de saída (ex: mega-sena).

### Exemplo

Para gerar combinações da Mega-Sena (1 a 60, agrupados em 6):

```bash
php gerar_combinacoes.php 1 60 6 mega-sena
```

O script irá gerar o arquivo: `output/mega-sena.txt` contendo todas as combinações sem repetição.

## Notas Técnicas

- O script utiliza **Generators** do PHP para eficiência de memória, permitindo gerar milhões de combinações sem estourar a RAM, escrevendo diretamente no disco à medida que processa.
