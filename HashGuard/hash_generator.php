<?php
/**
 * Gerador de Hash de Senhas
 * Funciona tanto via terminal quanto via interface web
 * 
 * Uso via terminal: php hash_generator.php "minha_senha"
 * Uso via web: acesse o arquivo no navegador
 */

// Função para gerar hash da senha
function gerarHash($senha) {
    return password_hash($senha, PASSWORD_DEFAULT);
}

// Função para verificar se a requisição é via CLI
function isCLI() {
    return php_sapi_name() === 'cli';
}

// Função para exibir resultado no terminal
function exibirResultadoTerminal($senha, $hash) {
    echo "\n" . str_repeat("=", 60) . "\n";
    echo "GERADOR DE HASH DE SENHAS\n";
    echo str_repeat("=", 60) . "\n";
    echo "Senha informada: " . $senha . "\n";
    echo "Hash gerado: " . $hash . "\n";
    echo "Tamanho do hash: " . strlen($hash) . " caracteres\n";
    echo str_repeat("=", 60) . "\n\n";
}

// Função para exibir interface web
function exibirInterfaceWeb() {
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gerador de Hash de Senhas</title>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                margin: 0;
                padding: 20px;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .container {
                background: white;
                border-radius: 15px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
                padding: 40px;
                max-width: 600px;
                width: 100%;
            }
            h1 {
                text-align: center;
                color: #333;
                margin-bottom: 30px;
                font-size: 2.5em;
            }
            .form-group {
                margin-bottom: 20px;
            }
            label {
                display: block;
                margin-bottom: 8px;
                font-weight: bold;
                color: #555;
            }
            input[type="password"], input[type="text"] {
                width: 100%;
                padding: 12px;
                border: 2px solid #ddd;
                border-radius: 8px;
                font-size: 16px;
                box-sizing: border-box;
                transition: border-color 0.3s;
            }
            input[type="password"]:focus, input[type="text"]:focus {
                outline: none;
                border-color: #667eea;
            }
            button {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 12px 30px;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                cursor: pointer;
                width: 100%;
                transition: transform 0.2s;
            }
            button:hover {
                transform: translateY(-2px);
            }
            .result {
                margin-top: 30px;
                padding: 20px;
                background: #f8f9fa;
                border-radius: 8px;
                border-left: 4px solid #667eea;
            }
            .result h3 {
                margin-top: 0;
                color: #333;
            }
            .hash-display {
                background: #e9ecef;
                padding: 15px;
                border-radius: 5px;
                font-family: monospace;
                word-break: break-all;
                margin: 10px 0;
            }
            .info {
                background: #d1ecf1;
                border: 1px solid #bee5eb;
                color: #0c5460;
                padding: 15px;
                border-radius: 8px;
                margin-top: 20px;
            }
            .toggle-password {
                background: #6c757d;
                color: white;
                border: none;
                padding: 8px 15px;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 10px;
                font-size: 14px;
            }
            .toggle-password:hover {
                background: #5a6268;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>🔐 Gerador de Hash</h1>
            
            <form method="POST">
                <div class="form-group">
                    <label for="senha">Digite sua senha:</label>
                    <input type="password" id="senha" name="senha" required 
                           placeholder="Digite a senha que deseja criptografar">
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        👁️ Mostrar/Ocultar Senha
                    </button>
                </div>
                
                <button type="submit">🔒 Gerar Hash</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['senha'])) {
                $senha = $_POST['senha'];
                $hash = gerarHash($senha);
                
                echo '<div class="result">';
                echo '<h3>✅ Hash Gerado com Sucesso!</h3>';
                echo '<p><strong>Senha informada:</strong> ' . htmlspecialchars($senha) . '</p>';
                echo '<p><strong>Hash gerado:</strong></p>';
                echo '<div class="hash-display">' . htmlspecialchars($hash) . '</div>';
                echo '<p><strong>Tamanho do hash:</strong> ' . strlen($hash) . ' caracteres</p>';
                echo '</div>';
            }
            ?>

            <div class="info">
                <h4>ℹ️ Informações:</h4>
                <ul>
                    <li>Este sistema usa o algoritmo <strong>PASSWORD_DEFAULT</strong> do PHP</li>
                    <li>O hash gerado é seguro e único para cada senha</li>
                    <li>Você pode usar este hash para armazenar senhas de forma segura</li>
                    <li>Para verificar uma senha, use: <code>password_verify($senha, $hash)</code></li>
                </ul>
            </div>
        </div>

        <script>
            function togglePassword() {
                const senhaInput = document.getElementById('senha');
                if (senhaInput.type === 'password') {
                    senhaInput.type = 'text';
                } else {
                    senhaInput.type = 'password';
                }
            }
        </script>
    </body>
    </html>
    <?php
}

// Lógica principal
if (isCLI()) {
    // Modo terminal
    if ($argc < 2) {
        echo "Uso: php hash_generator.php \"sua_senha\"\n";
        echo "Exemplo: php hash_generator.php \"minha_senha123\"\n";
        exit(1);
    }
    
    $senha = $argv[1];
    $hash = gerarHash($senha);
    exibirResultadoTerminal($senha, $hash);
    
} else {
    // Modo web
    exibirInterfaceWeb();
}
?> 