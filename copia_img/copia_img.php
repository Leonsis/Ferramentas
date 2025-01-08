<?php
    // URL do site do qual você deseja baixar as imagens
    $siteUrl = "https://hoogliato3.hoogli.dev.br/";

    $destino = __DIR__ . "/imagens";
    if (!is_dir($destino)) {
        mkdir($destino, 0777, true);
    }

    function baixarImagens($url, $destino) {
        // Carregar o HTML do site
        $html = file_get_contents($url);

        // Criar um objeto DOMDocument
        $dom = new DOMDocument();
        
        // Configura para suprimir warnings ao carregar o HTML
        @$dom->loadHTML($html);

        // Obter todas as tags <img>
        $images = $dom->getElementsByTagName('img');

        // Loop por todas as imagens
        foreach ($images as $img) {
            // Obter o link da imagem
            $src = $img->getAttribute('src');
            
            // Converter URLs relativas para absolutas
            $imageUrl = (strpos($src, 'http') === 0) ? $src : $url . '/' . ltrim($src, '/');

            // Nome do arquivo (extraído da URL da imagem)
            $fileName = basename(parse_url($imageUrl, PHP_URL_PATH));

            // Caminho completo do destino
            $filePath = $destino . '/' . $fileName;

            // Baixar e salvar a imagem no diretório
            if (@file_put_contents($filePath, file_get_contents($imageUrl))) {
                echo "Imagem baixada: $fileName\n";
            } else {
                echo "Falha ao baixar a imagem: $imageUrl\n";
            }
        }
    }

    // Chamar a função para baixar as imagens
    baixarImagens($siteUrl, $destino);

    echo "Processo concluído.";
?>