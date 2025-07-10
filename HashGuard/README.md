# 🔐 Gerador de Hash de Senhas

Este é um sistema em PHP puro que permite gerar hashes seguros de senhas, funcionando tanto via terminal quanto via interface web.

## 📋 Características

- ✅ Gera hashes seguros usando `PASSWORD_DEFAULT`
- ✅ Interface web moderna e responsiva
- ✅ Funciona via terminal (CLI)
- ✅ Interface intuitiva com botão para mostrar/ocultar senha
- ✅ Exibe informações detalhadas sobre o hash gerado
- ✅ Design responsivo e moderno

## 🚀 Como Usar

### Via Terminal (CLI)

```bash
# Navegue até a pasta do projeto
cd Ferramentas/HashGuard

# Execute o comando passando a senha como parâmetro
php hash_generator.php "minha_senha123"
```

**Exemplo de saída:**
```
============================================================
GERADOR DE HASH DE SENHAS
============================================================
Senha informada: minha_senha123
Hash gerado: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
Tamanho do hash: 60 caracteres
============================================================
```

### Via Interface Web

1. Coloque o arquivo `hash_generator.php` em um servidor web (Apache, Nginx, etc.)
2. Acesse o arquivo através do navegador: `http://localhost/hash_generator.php`
3. Digite a senha no campo de entrada
4. Clique em "Gerar Hash"
5. O hash será exibido na tela

## 🔧 Funcionalidades

### Interface Web
- **Campo de senha**: Digite a senha que deseja criptografar
- **Botão mostrar/ocultar**: Permite visualizar a senha digitada
- **Resultado**: Exibe o hash gerado, tamanho e informações
- **Design responsivo**: Funciona em dispositivos móveis e desktop

### Terminal
- **Parâmetro obrigatório**: A senha deve ser passada como argumento
- **Validação**: Verifica se a senha foi fornecida
- **Saída formatada**: Exibe o resultado de forma organizada

## 🛡️ Segurança

- Utiliza o algoritmo `PASSWORD_DEFAULT` do PHP (atualmente bcrypt)
- Cada hash é único, mesmo para a mesma senha
- O hash gerado é seguro para armazenamento em banco de dados
- Para verificar uma senha, use: `password_verify($senha, $hash)`

## 📁 Estrutura de Arquivos

```
Ferramentas/HashGuard/
├── hash_generator.php    # Arquivo principal do gerador
├── UpdateUserPassword.php # Comando Laravel (existente)
└── README.md            # Este arquivo
```

## 🔍 Exemplo de Verificação

Para verificar se uma senha corresponde ao hash gerado:

```php
<?php
$senha = "minha_senha123";
$hash = "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi";

if (password_verify($senha, $hash)) {
    echo "Senha correta!";
} else {
    echo "Senha incorreta!";
}
?>
```

## ⚠️ Observações

- O hash gerado é único a cada execução, mesmo para a mesma senha
- Este sistema é ideal para desenvolvimento e testes
- Para uso em produção, considere implementar validações adicionais
- O arquivo pode ser usado independentemente, sem dependências externas

## 🎨 Personalização

O sistema pode ser facilmente personalizado:
- Modifique o CSS para alterar o visual da interface web
- Adicione validações de força da senha
- Implemente diferentes algoritmos de hash
- Adicione funcionalidades como histórico de hashes gerados 