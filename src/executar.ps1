$ErrorActionPreference = "Stop"

function Run-Lottery {
    param(
        [string]$name,
        [int]$start,
        [int]$end,
        [int]$group
    )
    
    Write-Host "`n=========================================="
    Write-Host "Lançando: $name ..."
    Write-Host "=========================================="
    
    # Executa o script PHP Otimizado
    # Argumentos: <inicio> <fim> <agrupamento> <nome>
    php gerar_combinacoes.php $start $end $group $name
}

# 1. Lotofácil (1-25, 15) -> ~3.2 Milhões (Rápido)
Run-Lottery "lotofacil" 1 25 15

# 2. Dupla-Sena (1-50, 6) -> ~15 Milhões (Médio)
Run-Lottery "dupla-sena" 1 50 6

# 3. Quina (1-80, 5) -> ~24 Milhões (Médio)
Run-Lottery "quina" 1 80 5

# 4. Mega-Sena (1-60, 6) -> ~50 Milhões (Médio/Longo)
Run-Lottery "mega-sena" 1 60 6

# --------------------------------------------------------------------------
# AVISOS DE SEGURANÇA / LIMITES FÍSICOS
# --------------------------------------------------------------------------

# TIMEMANIA (1-80, 7)
# Gera ~3.1 BILHÕES de combinações.
# Espaço estimado necessário: ~65 GB.
# Tempo estimado: Várias horas.
# Se quiser rodar, descomente a linha abaixo:
# Run-Lottery "timemania" 1 80 7

# LOTOMANIA (1-100, 50)
# IMPOSSÍVEL.
# O número de combinações é 10^29 (um 1 com 29 zeros).
# Não existe computador capaz de armazenar isso.
# O script PHP possui uma trava de segurança e não executará mesmo se descomentar.
# Run-Lottery "lotomania" 1 100 50

Write-Host "`nProcesso multitarefa finalizado!"
