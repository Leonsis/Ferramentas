# EditDOMPHP

## Descrição
Este script PHP foi desenvolvido para manipular automaticamente um arquivo HTML, adicionando classes específicas (“sec” e “con”) a determinados elementos. Ele otimiza o trabalho ao preparar o código para ser integrado ao sistema de uma empresa. No entanto, ele também pode ser facilmente adaptado para adicionar outros atributos em grande escala, conforme necessário.

## Funcionalidades
- Verifica se o arquivo `arquivo.html` existe e possui conteúdo.
- Utiliza `DOMDocument` e `DOMXPath` para manipular a estrutura HTML.
- Adiciona a classe `sec` a elementos `<section>` e `<div>` que não a possuam.
- Adiciona a classe `con` a elementos como `<p>`, `<h1-h6>`, `<a>`, `<li>`, `<button>`, `<span>`, entre outros.
- Encapsula certos textos dentro da tag `<x>`, caso estejam em elementos vazios sem outras tags relevantes.
- Garante que as modificações sejam salvas corretamente no arquivo original.
- Exibe mensagens indicando as modificações realizadas e eventuais erros encontrados.

## Requisitos
- PHP 7.4 ou superior.
- Permissão de escrita no diretório onde o `arquivo.html` está localizado.

## Como Usar
1. Certifique-se de que o `arquivo.html` está no mesmo diretório do script PHP.
2. Execute o script via terminal:
   ```sh
   php script.php
   ```
3. O arquivo HTML será modificado automaticamente, adicionando as classes necessárias.
4. Caso o arquivo não seja encontrado ou esteja vazio, uma mensagem de erro será exibida.

## Personalização
Se precisar modificar quais tags recebem quais classes ou atributos, basta alterar as consultas `XPath` no script. Também é possível adicionar novas regras para atender a necessidades específicas.

## Observação
O script foi projetado para garantir a correta formatação do HTML antes de ser processado pelo sistema da empresa, evitando inconsistências e erros de exibição.

Caso precise de ajustes ou melhorias, sinta-se à vontade para modificar o código conforme necessário!

