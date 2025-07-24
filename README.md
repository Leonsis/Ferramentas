# Ferramentas

Este repositório reúne diversos sistemas e ferramentas que auxiliam na otimização do meu dia a dia no trabalho. Cada projeto foi desenvolvido para automatizar tarefas repetitivas e melhorar a eficiência do fluxo de trabalho, facilitando a manutenção e organização dos códigos.

---

## Projetos Incluídos

### 1. Baixador de Imagens

Um script PHP desenvolvido para baixar automaticamente todas as imagens de uma página web.  
**Principais funcionalidades:**
- Extrai as tags `<img>` do HTML de uma página e converte URLs relativas em absolutas.
- Utiliza cURL para baixar as imagens, adicionando um User-Agent para evitar bloqueios por parte do servidor.
- Salva as imagens em um diretório local, facilitando a organização dos arquivos.

---

### 2. Manipulador de HTML (Classes "sec" e "con")

Este script PHP manipula um arquivo HTML, adicionando classes específicas aos elementos, como "sec" e "con", com o intuito de padronizar a estrutura para integração com o sistema da empresa.  
**Principais funcionalidades:**
- Verifica se o arquivo HTML existe e possui conteúdo.
- Utiliza DOMDocument e DOMXPath para navegar e modificar a estrutura HTML.
- Adiciona classes a elementos `<section>`, `<div>`, `<p>`, `<h1-h6>`, `<a>`, entre outros.
- Encapsula textos em tags customizadas para manter a consistência do código.

---

### 3. VerificadorCSS

Um sistema em Python que extrai e combina os estilos CSS de arquivos HTML e CSS externos, permitindo identificar e remover estilos duplicados para manter o código mais limpo.  
**Principais funcionalidades:**
- **Extração de CSS Inline:** Lê o arquivo HTML (index.html) e extrai os estilos contidos nas tags `<style>`, salvando-os em um arquivo (por padrão, `home.css`).
- **Combinação de CSS Externo:** Lê um arquivo CSS externo (style.css) e une seu conteúdo ao CSS extraído.
- **Futuras Melhorias:** Planeja implementar uma análise que identifique e liste estilos duplicados, facilitando a remoção e a otimização do código.

---

### 4. HashGuard

Um gerador de hash de senhas em PHP que funciona tanto via terminal quanto via interface web, desenvolvido para criar hashes seguros de senhas utilizando o algoritmo PASSWORD_DEFAULT do PHP.  
**Principais funcionalidades:**
- **Geração de Hash Seguro:** Utiliza o algoritmo bcrypt (PASSWORD_DEFAULT) para criar hashes únicos e seguros de senhas.
- **Interface Web Moderna:** Interface responsiva e intuitiva com design moderno, permitindo gerar hashes através do navegador.
- **Funcionamento via Terminal:** Possibilidade de uso via linha de comando, ideal para automação e scripts.
- **Verificação de Senhas:** Inclui informações sobre como verificar senhas usando `password_verify()`.
- **Design Responsivo:** Interface adaptável para dispositivos móveis e desktop.

---

### 5. Verificador de Domínios

Um sistema em Python que verifica automaticamente os domínios presentes em um diretório local, validando o nome e tentando resolver o endereço IP de cada domínio.
**Principais funcionalidades:**
- Lista todos os subdiretórios de um caminho especificado (por padrão `/var/www`), considerando cada um como um domínio.
- Verifica se o nome do subdiretório é um domínio válido.
- Tenta resolver o IP de cada domínio usando DNS.
- Exibe uma lista com o domínio e seu respectivo IP, ou uma mensagem de erro caso não seja possível resolver.

---

### 6. ZipDeploy

Uma ferramenta Python automatizada para criar arquivos ZIP de múltiplos projetos web em grande escala, ideal para servidores que hospedam diversos domínios e precisam de backup ou deploy automatizado.
**Principais funcionalidades:**
- **Processamento em lote**: Processa automaticamente uma lista predefinida de domínios
- **Verificação de existência**: Verifica se cada diretório existe antes de tentar zipar
- **Nomenclatura inteligente**: Cria arquivos ZIP com o nome do domínio principal
- **Exclusão automática**: Evita incluir o próprio arquivo ZIP no processo
- **Logs detalhados**: Fornece feedback completo sobre o processo
- **Tratamento de erros**: Captura e reporta erros sem interromper o processamento
- **Automação via cron**: Permite execução programada para backups automáticos

---

Este repositório foi criado para centralizar todas as ferramentas que contribuem para a otimização dos processos de desenvolvimento e manutenção dos projetos, poupando tempo e garantindo maior consistência no trabalho diário.

Contribuições, sugestões e melhorias são sempre bem-vindas!

---

> Para mais informações sobre cada projeto, consulte os respectivos READMEs contidos em cada pasta ou arquivo do projeto.
