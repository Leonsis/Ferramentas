# verificador_dominios

Este diretório contém o script `verifica_dominio.py`, que serve para verificar domínios presentes em um diretório local e tentar resolver seus endereços IP.

## O que o script faz?

- Lista todos os subdiretórios de um caminho especificado (por padrão `/var/www`).
- Considera que cada subdiretório é o nome de um domínio.
- Verifica se o nome do subdiretório é um domínio válido.
- Tenta resolver o IP de cada domínio usando DNS.
- Exibe uma lista com o domínio e seu respectivo IP, ou uma mensagem de erro caso não seja possível resolver.

## Como usar

1. **Edite o caminho**
   - No início do arquivo, altere a variável `CAMINHO` para o diretório onde estão os subdiretórios com nomes de domínios.
   - Exemplo:
     ```python
     CAMINHO = '/var/www'
     ```

2. **Execute o script**
   - No terminal, navegue até o diretório `verificador_dominios` e execute:
     ```bash
     python verifica_dominio.py
     ```

3. **Saída esperada**
   - O script irá imprimir no terminal uma lista no formato:
     ```
     exemplo.com - 192.168.0.1
     dominio-invalido - Nome inválido
     outrodominio.com - Não resolvido
     ```

## Requisitos
- Python 3.x

## Observações
- O script apenas verifica domínios baseados nos nomes dos subdiretórios.
- Para domínios que não puderem ser resolvidos, será exibida a mensagem "Não resolvido".
- Para nomes que não forem domínios válidos, será exibida a mensagem "Nome inválido". 