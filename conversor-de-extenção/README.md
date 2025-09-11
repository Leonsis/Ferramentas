# Conversor de Extensões de Arquivos

Um script Python interativo e versátil para converter extensões de arquivos em lote, permitindo renomear múltiplos arquivos de uma vez com diferentes opções de configuração.

## 📋 Sobre o Projeto

O **Conversor de Extensões** é uma ferramenta desenvolvida em Python que facilita a alteração em massa de extensões de arquivos. Ideal para organizadores de arquivos, desenvolvedores, designers e qualquer pessoa que precise renomear grandes quantidades de arquivos de forma eficiente e segura.

### 🎯 Principais Características

- **Interface Dupla**: Modo interativo para uso casual e modo linha de comando para automação
- **Busca Flexível**: Processa apenas a raiz do diretório ou inclui subpastas recursivamente
- **Segurança**: Verificações de existência de arquivos e confirmação antes de executar
- **Relatórios Detalhados**: Mostra sucessos, falhas e arquivos processados
- **Modo Simulação**: Preview das alterações sem executar (dry-run)
- **Tratamento de Erros**: Lida com permissões, arquivos inexistentes e outros problemas

## 🚀 Como Funciona

### Modo Interativo
O script solicita informações passo a passo:
1. **Extensão atual** dos arquivos (ex: `.txt`, `.jpg`)
2. **Nova extensão** desejada (ex: `.pdf`, `.png`)
3. **Diretório** para processar (ou usa o atual)
4. **Escopo da busca** (raiz apenas ou incluir subpastas)
5. **Confirmação** antes de executar as alterações

### Modo Linha de Comando
Permite automação completa com argumentos:
- Especificação direta de parâmetros
- Integração com scripts e automações
- Modo simulação para testar antes de executar

## 📖 Como Usar

### Pré-requisitos
- Python 3.6 ou superior
- Permissões de leitura/escrita no diretório de destino

### Instalação
```bash
# Clone ou baixe o arquivo
# Não requer instalação de dependências externas
```

### Uso Básico

#### Modo Interativo
```bash
python convercor-extencao.py
```

O script irá guiá-lo através de uma série de perguntas:
```
=== Conversor de Extensões de Arquivos ===

Digite a extensão atual dos arquivos (ex: .txt, .jpg): .txt
Digite a nova extensão (ex: .pdf, .png): .md
Digite o caminho do diretório (ou pressione Enter para usar o diretório atual): 
Opções de busca:
1. Apenas arquivos na raiz do diretório
2. Incluir arquivos em subpastas (recursivo)
Escolha uma opção (1 ou 2): 2
```

#### Modo Linha de Comando

**Exemplo básico:**
```bash
python convercor-extencao.py -a .txt -n .md
```

**Com diretório específico:**
```bash
python convercor-extencao.py -a jpg -n png -d /caminho/para/pasta
```

**Incluindo subpastas:**
```bash
python convercor-extencao.py -a .docx -n .pdf -d ./documentos -r
```

**Modo simulação (dry-run):**
```bash
python convercor-extencao.py -a .txt -n .md --dry-run
```

### Parâmetros Disponíveis

| Parâmetro | Descrição | Exemplo |
|-----------|-----------|---------|
| `-a, --atual` | Extensão atual dos arquivos | `.txt`, `jpg` |
| `-n, --nova` | Nova extensão desejada | `.pdf`, `png` |
| `-d, --diretorio` | Diretório para processar | `/caminho/pasta` |
| `-r, --recursivo` | Incluir subpastas na busca | - |
| `--dry-run` | Simular sem executar | - |

## 🛠️ Como Foi Desenvolvido

### Arquitetura do Código

O script foi estruturado seguindo princípios de programação limpa e modularidade:

#### **Funções Principais:**

1. **`obter_entrada_usuario()`**
   - Interface interativa para coleta de dados
   - Validação de entrada do usuário
   - Normalização de extensões (adiciona ponto se necessário)

2. **`encontrar_arquivos()`**
   - Busca arquivos com extensão específica
   - Suporte a busca recursiva e não-recursiva
   - Tratamento de erros de permissão

3. **`renomear_arquivo()`**
   - Executa o renomeamento individual
   - Verifica conflitos de nomes
   - Tratamento de erros de sistema

4. **`executar_conversao()`**
   - Orquestra todo o processo
   - Gera relatórios detalhados
   - Interface de confirmação

5. **`modo_comando()`**
   - Processamento de argumentos da linha de comando
   - Integração com argparse para validação
   - Suporte ao modo dry-run

### **Tecnologias e Bibliotecas Utilizadas:**

- **Python 3.6+**: Linguagem base
- **os**: Manipulação de sistema de arquivos
- **pathlib**: Trabalho com caminhos (importado mas não utilizado extensivamente)
- **argparse**: Processamento de argumentos de linha de comando
- **sys**: Controle de saída e argumentos do sistema

### **Decisões de Design:**

1. **Interface Dupla**: Permite flexibilidade para diferentes tipos de usuários
2. **Validação Robusta**: Múltiplas verificações antes de executar operações
3. **Feedback Detalhado**: Usuário sempre sabe o que está acontecendo
4. **Modo Simulação**: Permite testar sem riscos
5. **Tratamento de Erros**: Lida graciosamente com problemas comuns

### **Estrutura de Arquivos:**
```
convercor-extencao.py    # Script principal
README.md               # Documentação
```

## 🔧 Casos de Uso Comuns

### **Organização de Documentos**
```bash
# Converter documentos Word para PDF
python convercor-extencao.py -a .docx -n .pdf -d ./documentos -r
```

### **Processamento de Imagens**
```bash
# Converter JPG para PNG
python convercor-extencao.py -a .jpg -n .png -d ./fotos
```

### **Limpeza de Arquivos Temporários**
```bash
# Renomear arquivos temporários
python convercor-extencao.py -a .tmp -n .bak -d ./temp
```

### **Migração de Formatos**
```bash
# Converter arquivos de texto
python convercor-extencao.py -a .txt -n .md -d ./notas -r
```

## ⚠️ Considerações de Segurança

- **Backup**: Sempre faça backup antes de executar em grandes volumes
- **Teste Primeiro**: Use `--dry-run` para verificar o que será alterado
- **Permissões**: Certifique-se de ter permissões adequadas no diretório
- **Conflitos**: O script não sobrescreve arquivos existentes

## 🐛 Solução de Problemas

### **Erro de Permissão**
```
Erro: Sem permissão para acessar o diretório
```
**Solução**: Execute com permissões adequadas ou mude o diretório

### **Arquivo Já Existe**
```
Aviso: O arquivo 'novo_nome.ext' já existe. Pulando...
```
**Solução**: Remova ou renomeie arquivos conflitantes manualmente

### **Diretório Não Encontrado**
```
Erro: O diretório '/caminho' não existe!
```
**Solução**: Verifique o caminho e certifique-se de que existe

## 📝 Exemplo de Saída

```
=== Conversor de Extensões de Arquivos ===

Buscando arquivos com extensão '.txt' em '/Users/usuario/documentos'...
Incluindo subpastas...

Encontrados 5 arquivo(s):
  - /Users/usuario/documentos/nota1.txt
  - /Users/usuario/documentos/nota2.txt
  - /Users/usuario/documentos/pasta/nota3.txt

Deseja renomear todos os arquivos de '.txt' para '.md'?
Digite 'sim' para confirmar: sim

Renomeando arquivos...
✓ /Users/usuario/documentos/nota1.txt
✓ /Users/usuario/documentos/nota2.txt
✓ /Users/usuario/documentos/pasta/nota3.txt

=== Relatório Final ===
Arquivos renomeados com sucesso: 5
Falhas: 0
Total processado: 5
```

## 🤝 Contribuições

Este é um projeto simples e direto, mas melhorias são sempre bem-vindas:

- Adicionar suporte a padrões de nomeação mais complexos
- Interface gráfica (GUI)
- Suporte a renomeação baseada em metadados
- Integração com sistemas de backup automático

## 📄 Licença

Este projeto é de domínio público e pode ser usado livremente para qualquer propósito.

---

**Desenvolvido com ❤️ em Python**
