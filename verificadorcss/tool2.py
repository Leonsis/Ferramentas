from bs4 import BeautifulSoup

# Lê o conteúdo do arquivo 'style.css'.
with open('style.css', 'r', encoding='utf-8') as file:
    css_content = file.read()

# Informe o nome do arquivo para que ele seja lido.
nameFile = "home.css"
with open(nameFile, 'r', encoding='utf-8') as file:
    css_content2 = file.read()

# Adiciona o conteúdo de 'style.css' ao final de 'home.css'.
with open(nameFile, 'a', encoding='utf-8') as file:
    file.write(css_content)

# Lê novamente o conteúdo atualizado de 'home.css'.
with open(nameFile, 'r', encoding='utf-8') as file:
    updated_content = file.read()

# Exibe os conteúdos.
print("Conteúdo do style.css:")
print(css_content)

print("\nConteúdo original do home.css:")
print(css_content2)

print("\nConteúdo atualizado do home.css:")
print(updated_content)
