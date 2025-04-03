# VerificadorCSS

VerificadorCSS é um pequeno sistema criado para ajudar desenvolvedores a otimizar seus estilos CSS, identificando e eliminando códigos repetidos. O sistema consiste em duas partes:

1. **Extração e Combinação de CSS**  
   Um script Python (tool.py) lê um arquivo HTML e extrai todo o CSS que estiver dentro de tags `<style>`. Esse CSS é combinado e salvo em um arquivo (por padrão, `home.css`).

2. **Unificação e Verificação de Duplicidades**  
   Outro script Python (tool2.py) lê um arquivo CSS externo (por exemplo, `style.css`) e o une com o CSS extraído (armazenado em `home.css`). Em uma versão futura, esse script poderá ser estendido para identificar e listar os estilos duplicados, auxiliando o desenvolvedor a remover o código repetido e deixar o arquivo CSS mais limpo e organizado.

---

## Funcionalidades

- **Extração de CSS Inline:**  
  O script tool.py percorre o arquivo HTML (index.html), localiza todas as tags `<style>` e junta os conteúdos encontrados.

- **Combinação de CSS Externo:**  
  O script tool2.py lê o conteúdo de um arquivo CSS externo (style.css) e adiciona ao arquivo de CSS combinado (home.css).

- **Otimização de Estilos (Planejado):**  
  A ideia é que, em uma futura versão, o sistema analise o CSS combinado para identificar regras de estilos duplicadas, permitindo que o desenvolvedor remova as repetições e otimize o código.

---

## Requisitos

- Python 3.x instalado no ambiente.
- Biblioteca [BeautifulSoup](https://www.crummy.com/software/BeautifulSoup/bs4/doc/) (bs4). Para instalar, utilize:
  ```sh
  pip install beautifulsoup4
  ```
- Arquivos de entrada:
  - `index.html`: arquivo HTML que contém o CSS inline.
  - `style.css`: arquivo CSS com estilos externos.
  
Os arquivos resultantes serão gravados (por padrão) em `home.css`.

---

## Como Utilizar

1. **Preparação dos Arquivos:**

   Certifique-se de que os arquivos `index.html` e `style.css` estejam no mesmo diretório dos scripts.

2. **Extraindo CSS Inline (tool.py):**

   Execute o script para extrair o CSS contido nas tags `<style>` do HTML:
   ```sh
   python tool.py
   ```
   O script irá ler o arquivo `index.html`, combinar os conteúdos das tags `<style>` e salvar o resultado em `home.css`.

3. **Combinando com CSS Externo (tool2.py):**

   Para unir o CSS extraído com o CSS externo:
   ```sh
   python tool2.py
   ```
   Esse script lerá o conteúdo do `style.css` e o adicionará ao final de `home.css`. Ao final, ele exibirá no terminal os conteúdos:
   - Do arquivo `style.css`
   - Do conteúdo original de `home.css`
   - Do conteúdo atualizado de `home.css`

4. **Análise e Remoção de Duplicidades (Funcionalidade Futura):**

   O próximo passo planejado é a implementação de uma análise para identificar estilos duplicados no CSS combinado. Isso permitirá que o desenvolvedor remova trechos repetitivos e mantenha o código mais limpo e eficiente.

---

## Estrutura do Sistema

- **tool.py**  
  Responsável por extrair e combinar os estilos CSS inline presentes no arquivo HTML.
  
- **tool2.py**  
  Responsável por ler o arquivo CSS externo e anexar seu conteúdo ao CSS extraído. Também exibe os conteúdos antes e depois da união.

- **index.html**  
  Arquivo HTML de entrada que pode conter estilos inline a serem extraídos.

- **style.css**  
  Arquivo CSS de entrada que contém os estilos externos a serem combinados com o CSS extraído.

- **home.css**  
  Arquivo resultante contendo todos os estilos combinados.

---

## Possíveis Melhorias

- **Verificação de Estilos Repetidos:**  
  Implementar uma funcionalidade para identificar e listar os estilos duplicados no arquivo CSS combinado, facilitando a limpeza do código.

- **Interface de Usuário:**  
  Desenvolver uma interface gráfica ou uma ferramenta web para facilitar a visualização e remoção de duplicidades.

- **Configurações Personalizadas:**  
  Permitir a configuração de nomes de arquivos e parâmetros de processamento via um arquivo de configuração.

---

VerificadorCSS foi criado para simplificar o processo de otimização de CSS, permitindo que desenvolvedores mantenham seus projetos organizados e eficientes. Contribuições e sugestões para melhorias são bem-vindas!