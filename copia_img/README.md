# Baixador de Imagens de uma Página Web

Este script PHP permite baixar automaticamente todas as imagens presentes em uma página web específica. Ele analisa o HTML da página, identifica as imagens e salva os arquivos localmente.

## 🚀 Funcionalidades
- Obtém todas as imagens de uma página web fornecida.
- Converte URLs relativas em absolutas corretamente.
- Usa cURL para baixar imagens, garantindo maior compatibilidade.
- Adiciona um **User-Agent** para evitar bloqueios por servidores.

## 🛠️ Requisitos
Para executar este script, você precisa de:
- PHP 7.4 ou superior
- Extensão **cURL** ativada no PHP

## 📥 Instalação
1. **Clone ou baixe o script**:
   ```sh
   git clone https://github.com/seu-repositorio/baixador-imagens.git
   cd baixador-imagens
   ```
   Ou apenas baixe o arquivo PHP e coloque-o em um diretório acessível.

2. **Verifique se o cURL está ativado** no seu PHP:
   ```sh
   php -m | grep curl
   ```
   Se não estiver ativado, edite o `php.ini` e descomente a linha:
   ```ini
   extension=curl
   ```

## 🏃‍♂️ Como Usar
1. **Edite o arquivo PHP** e altere a variável `$siteUrl` para a URL da página que contém as imagens:
   ```php
   $siteUrl = "https://html.themeholy.com/realar/demo/home-2-op.html";
   ```

2. **Execute o script** no terminal:
   ```sh
   php baixar_imagens.php
   ```

3. As imagens serão salvas na pasta `imagens` dentro do mesmo diretório do script.

## 🔧 Estrutura do Código
### 1️⃣ Função `getAbsoluteUrl($src, $baseUrl)`
Corrige URLs relativas, garantindo que todas as imagens sejam baixadas corretamente.

### 2️⃣ Função `baixarImagem($url, $destino)`
Baixa a imagem usando **cURL**, adicionando um User-Agent para evitar bloqueios.

### 3️⃣ Função `baixarImagens($url, $destino)`
Percorre todas as tags `<img>` do HTML, extrai os links das imagens e chama a função `baixarImagem()` para salvar os arquivos.

## 🔥 Exemplo de Saída
```sh
Imagem baixada: logo.png
Imagem baixada: banner.jpg
Falha ao baixar: https://exemplo.com/icone.svg
Processo concluído.
```

## 🛠️ Possíveis Erros e Soluções
| Erro | Solução |
|------|---------|
| `Falha ao baixar` | Verifique se a URL da imagem está acessível no navegador. |
| `Permission denied` | Certifique-se de que o diretório de destino tem permissão de escrita. |
| `cURL error 60: SSL certificate problem` | Adicione `curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);` no código. |

## 📜 Licença
Este projeto está sob a licença MIT. Sinta-se à vontade para modificar e distribuir.

## 🤝 Contribuições
Se quiser melhorar o script, faça um **fork** e envie um **pull request**! 😊