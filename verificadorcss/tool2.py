from bs4 import BeautifulSoup

# Lê o conteúdo do arquivo 'style.css'
with open('style.css', 'r', encoding='utf-8') as file:
    css_content = file.read()

# Lê o conteúdo do arquivo 'home.css' gerado
nameFile = "home.css"
with open(nameFile, 'r', encoding='utf-8') as file:
    css_content2 = file.read()

# Agora você pode continuar a lógica para verificar classes e IDs iguais, e ordenar o conteúdo
print("Conteúdo do style.css:")
print(css_content)

print("\nConteúdo do home.css:")
print(css_content2)
