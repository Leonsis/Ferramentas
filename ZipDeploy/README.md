# ZipDeploy

## Descrição

O **ZipDeploy** é uma ferramenta Python automatizada para criar arquivos ZIP de múltiplos projetos web em grande escala. Ideal para servidores que hospedam diversos domínios e precisam de backup ou deploy automatizado.

## Funcionalidades

- ✅ **Processamento em lote**: Processa automaticamente uma lista predefinida de domínios
- ✅ **Verificação de existência**: Verifica se cada diretório existe antes de tentar zipar
- ✅ **Nomenclatura inteligente**: Cria arquivos ZIP com o nome do domínio principal
- ✅ **Exclusão automática**: Evita incluir o próprio arquivo ZIP no processo
- ✅ **Logs detalhados**: Fornece feedback completo sobre o processo
- ✅ **Tratamento de erros**: Captura e reporta erros sem interromper o processamento

## Como Funciona

### Estrutura de Diretórios

O script assume que todos os projetos estão organizados da seguinte forma:

```
/var/www/
├── villasboasempreendimentos.com.br/
├── extintoreslorenzi.com.br/
├── ritatrindade.com/
├── usina61.com.br/
└── ... (outros domínios)
```

### Processo de Execução

1. **Leitura da Lista**: O script carrega uma lista predefinida de domínios
2. **Verificação**: Para cada domínio, verifica se o diretório existe em `/var/www/`
3. **Criação do ZIP**: Se o diretório existir, cria um arquivo ZIP contendo todo o conteúdo
4. **Nomenclatura**: O arquivo ZIP recebe o nome do domínio principal (ex: `villasboasempreendimentos.zip`)
5. **Logs**: Registra o progresso e qualquer erro encontrado

### Exemplo de Saída

```
[ZIPANDO] villasboasempreendimentos.com.br → villasboasempreendimentos.zip
[OK] Criado: /var/www/villasboasempreendimentos.com.br/villasboasempreendimentos.zip

[AVISO] Diretório não encontrado: /var/www/dominioinexistente.com.br

[ZIPANDO] extintoreslorenzi.com.br → extintoreslorenzi.zip
[OK] Criado: /var/www/extintoreslorenzi.com.br/extintoreslorenzi.zip
```

## Pré-requisitos

- **Python 3.x**
- **Comando `zip`** instalado no sistema
- **Permissões de leitura** nos diretórios dos projetos
- **Permissões de escrita** para criar os arquivos ZIP

### Instalação do zip (se necessário)

**Ubuntu/Debian:**
```bash
sudo apt-get install zip
```

**CentOS/RHEL:**
```bash
sudo yum install zip
```

**macOS:**
```bash
brew install zip
```

## Como Usar

### 1. Configuração

Edite o arquivo `ZipDeploy.py` e ajuste:

- **Lista de domínios**: Modifique a lista `dominios` conforme necessário
- **Caminho base**: Altere `base_path` se seus projetos estiverem em outro local

### 2. Execução

```bash
cd ZipDeploy
python3 ZipDeploy.py
```

### 3. Execução com Logs Detalhados

```bash
python3 ZipDeploy.py 2>&1 | tee zipdeploy.log
```

## Personalização

### Adicionar Novos Domínios

Edite a lista `dominios` no arquivo:

```python
dominios = [
    "meudominio.com.br",
    "outrodominio.com",
    # ... outros domínios
]
```

### Alterar Caminho Base

```python
base_path = "/caminho/para/seus/projetos"
```

### Modificar Nomenclatura dos ZIPs

Para alterar como os arquivos ZIP são nomeados, modifique a linha:

```python
zip_name = dominio.split(".")[0] + ".zip"
```

## Casos de Uso

### Backup Automatizado
- Execute periodicamente via cron para criar backups
- Útil para servidores com muitos domínios

### Deploy Preparatório
- Crie arquivos ZIP antes de fazer deploy
- Facilita a transferência de arquivos

### Migração de Servidores
- Prepare todos os projetos para transferência
- Mantenha a estrutura organizada

## Exemplo de Cron Job

Para executar automaticamente todos os dias às 2h da manhã:

```bash
0 2 * * * cd /caminho/para/ZipDeploy && python3 ZipDeploy.py >> /var/log/zipdeploy.log 2>&1
```

## Tratamento de Erros

O script inclui tratamento robusto de erros:

- **Diretórios inexistentes**: Apenas registra aviso e continua
- **Permissões insuficientes**: Captura e reporta o erro
- **Falhas no comando zip**: Registra erro específico
- **Processo não interrompido**: Continua com os próximos domínios

## Logs e Monitoramento

### Tipos de Mensagens

- `[ZIPANDO]`: Início do processo para um domínio
- `[OK]`: Sucesso na criação do ZIP
- `[AVISO]`: Diretório não encontrado
- `[ERRO]`: Falha no processo de zipagem

### Monitoramento

```bash
# Verificar logs em tempo real
tail -f zipdeploy.log

# Contar sucessos
grep "\[OK\]" zipdeploy.log | wc -l

# Verificar erros
grep "\[ERRO\]" zipdeploy.log
```

## Limitações

- Requer que o comando `zip` esteja disponível no sistema
- Processa apenas diretórios existentes
- Não faz compressão diferencial
- Não inclui opções de criptografia

## Contribuição

Para melhorar o projeto:

1. Adicione novas funcionalidades
2. Implemente compressão diferencial
3. Adicione suporte a outros formatos
4. Crie interface web para gerenciamento

## Licença

Este projeto é de uso livre para fins comerciais e pessoais. 