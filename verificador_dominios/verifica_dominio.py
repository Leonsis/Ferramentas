import os
import socket
import re

CAMINHO = '/var/www'  # Caminho com os diretórios (nomes de domínios)

def listar_diretorios(caminho):
    return [nome for nome in os.listdir(caminho) if os.path.isdir(os.path.join(caminho, nome))]

def eh_dominio_valido(dominio):
    # Verifica se o domínio parece válido com uma expressão regular simples
    regex = r'^(?!\-)(?:[a-zA-Z0-9\-]{1,63}\.)+[a-zA-Z]{2,}$'
    return re.match(regex, dominio)

def resolver_ip(dominio):
    try:
        return socket.gethostbyname(dominio)
    except Exception:
        return 'Não resolvido'

def gerar_lista_dominios_ips(caminho):
    dominios = listar_diretorios(caminho)
    resultado = []
    for dominio in dominios:
        if not eh_dominio_valido(dominio):
            resultado.append(f"{dominio} - Nome inválido")
            continue
        ip = resolver_ip(dominio)
        resultado.append(f"{dominio} - {ip}")
    return resultado

if __name__ == "__main__":
    lista = gerar_lista_dominios_ips(CAMINHO)
    for item in lista:
        print(item)
