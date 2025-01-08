# Ferramenta para juntar os códigos 
# css que estão espalhados no aquivo

from bs4 import BeautifulSoup

# Lendo o arquivo HTML
with open('index.html', 'r', encoding='utf-8') as file:
    html_content = file.read()

# Criando o objeto BeautifulSoup
soup = BeautifulSoup(html_content, 'html.parser')

# Encontrando todas as tags <style>
styles = soup.find_all('style')

# Juntando o conteúdo de todas as tags <style>
combined_styles = "\n".join(
    style.string.strip() for style in styles if style.string
)

# Exibindo o conteúdo combinado
print("Conteúdo combinado de todas as tags <style>:")
print(combined_styles)

# Coloque o nome do aruivo css
nomeFile = 'home.css'

# Salvando o conteúdo combinado em um arquivo CSS
with open(nomeFile , 'w', encoding='utf-8') as css_file:
    css_file.write(combined_styles)
print("Estilos combinados foram salvos em 'combined_styles.css'.")
