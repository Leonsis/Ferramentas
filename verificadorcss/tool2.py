import re
from collections import defaultdict

# Lê o conteúdo do arquivo 'style.css'.
with open('style.css', 'r', encoding='utf-8') as file:
    css_content = file.read()

# Informe o nome do arquivo para que ele seja lido e atualizado.
nameFile = "home.css"

# Adiciona o conteúdo de 'style.css' ao final de 'home.css'.
with open(nameFile, 'a', encoding='utf-8') as file:
    file.write(css_content)

# Função para organizar o CSS e mesclar classes repetidas
def organize_css(file_path):
    with open(file_path, 'r', encoding='utf-8') as file:
        css_content = file.read()

    # Regex para capturar as definições de classes
    class_pattern = re.compile(r'(\.[\w-]+)\s*{([^}]*)}')
    matches = class_pattern.findall(css_content)

    # Dicionário para armazenar classes e suas propriedades
    class_dict = defaultdict(list)

    for class_name, properties in matches:
        # Remove espaços extras e adiciona as propriedades ao dicionário
        cleaned_properties = properties.strip()
        class_dict[class_name].append(cleaned_properties)

    # Mescla propriedades repetidas de cada classe
    organized_classes = {}
    for class_name, properties_list in class_dict.items():
        combined_properties = "; ".join(properties_list)
        # Remove propriedades duplicadas mantendo a ordem
        unique_properties = "; ".join(
            dict.fromkeys(combined_properties.split("; "))
        )
        organized_classes[class_name] = unique_properties

    # Recria o conteúdo CSS organizado
    organized_css = "\n\n".join(
        f"{class_name} {{\n   {properties}\n}}"
        for class_name, properties in organized_classes.items()
    )

    # Escreve o conteúdo organizado de volta ao arquivo
    with open(file_path, 'w', encoding='utf-8') as file:
        file.write(organized_css)

    print("Arquivo CSS organizado com sucesso!")

# Chama a função para organizar o arquivo 'home.css'
organize_css(nameFile)

# Agora você pode verificar o conteúdo atualizado dos arquivos
print("Conteúdo do style.css:")
print(css_content)

with open(nameFile, 'r', encoding='utf-8') as file:
    updated_home_css = file.read()

print("\nConteúdo atualizado do home.css:")
print(updated_home_css)
