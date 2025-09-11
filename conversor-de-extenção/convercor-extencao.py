#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Conversor de Extensões de Arquivos
Um script Python interativo e versátil para converter extensões de arquivos em lote.
"""

import os
import sys
import argparse
from pathlib import Path


def normalizar_extensao(extensao):
    """
    Normaliza a extensão adicionando ponto se necessário.
    
    Args:
        extensao (str): Extensão a ser normalizada
        
    Returns:
        str: Extensão normalizada com ponto
    """
    if not extensao.startswith('.'):
        return '.' + extensao
    return extensao


def obter_entrada_usuario():
    """
    Interface interativa para coleta de dados do usuário.
    
    Returns:
        tuple: (extensao_atual, extensao_nova, diretorio, recursivo)
    """
    print("=== Conversor de Extensões de Arquivos ===\n")
    
    # Obter extensão atual
    extensao_atual = input("Digite a extensão atual dos arquivos (ex: .txt, .jpg): ").strip()
    if not extensao_atual:
        print("Erro: Extensão atual é obrigatória!")
        sys.exit(1)
    extensao_atual = normalizar_extensao(extensao_atual)
    
    # Obter nova extensão
    extensao_nova = input("Digite a nova extensão (ex: .pdf, .png): ").strip()
    if not extensao_nova:
        print("Erro: Nova extensão é obrigatória!")
        sys.exit(1)
    extensao_nova = normalizar_extensao(extensao_nova)
    
    # Obter diretório
    diretorio = input("Digite o caminho do diretório (ou pressione Enter para usar o diretório atual): ").strip()
    if not diretorio:
        diretorio = os.getcwd()
    
    # Verificar se diretório existe
    if not os.path.exists(diretorio):
        print(f"Erro: O diretório '{diretorio}' não existe!")
        sys.exit(1)
    
    # Obter opção de busca
    print("\nOpções de busca:")
    print("1. Apenas arquivos na raiz do diretório")
    print("2. Incluir arquivos em subpastas (recursivo)")
    
    while True:
        opcao = input("Escolha uma opção (1 ou 2): ").strip()
        if opcao == '1':
            recursivo = False
            break
        elif opcao == '2':
            recursivo = True
            break
        else:
            print("Opção inválida! Digite 1 ou 2.")
    
    return extensao_atual, extensao_nova, diretorio, recursivo


def encontrar_arquivos(diretorio, extensao, recursivo=False):
    """
    Encontra arquivos com a extensão especificada.
    
    Args:
        diretorio (str): Diretório para buscar
        extensao (str): Extensão dos arquivos
        recursivo (bool): Se deve incluir subpastas
        
    Returns:
        list: Lista de caminhos de arquivos encontrados
    """
    arquivos_encontrados = []
    
    try:
        if recursivo:
            # Busca recursiva
            for root, dirs, files in os.walk(diretorio):
                for file in files:
                    if file.endswith(extensao):
                        arquivos_encontrados.append(os.path.join(root, file))
        else:
            # Busca apenas na raiz
            for item in os.listdir(diretorio):
                item_path = os.path.join(diretorio, item)
                if os.path.isfile(item_path) and item.endswith(extensao):
                    arquivos_encontrados.append(item_path)
    
    except PermissionError:
        print(f"Erro: Sem permissão para acessar o diretório '{diretorio}'")
        return []
    except Exception as e:
        print(f"Erro ao buscar arquivos: {e}")
        return []
    
    return arquivos_encontrados


def renomear_arquivo(caminho_original, extensao_nova):
    """
    Renomeia um arquivo individual.
    
    Args:
        caminho_original (str): Caminho do arquivo original
        extensao_nova (str): Nova extensão
        
    Returns:
        bool: True se bem-sucedido, False caso contrário
    """
    try:
        # Obter diretório e nome base do arquivo
        diretorio = os.path.dirname(caminho_original)
        nome_base = os.path.splitext(os.path.basename(caminho_original))[0]
        
        # Criar novo caminho
        novo_caminho = os.path.join(diretorio, nome_base + extensao_nova)
        
        # Verificar se arquivo de destino já existe
        if os.path.exists(novo_caminho):
            print(f"Aviso: O arquivo '{novo_caminho}' já existe. Pulando...")
            return False
        
        # Renomear arquivo
        os.rename(caminho_original, novo_caminho)
        return True
        
    except Exception as e:
        print(f"Erro ao renomear '{caminho_original}': {e}")
        return False


def executar_conversao(extensao_atual, extensao_nova, diretorio, recursivo, dry_run=False):
    """
    Executa o processo de conversão de extensões.
    
    Args:
        extensao_atual (str): Extensão atual
        extensao_nova (str): Nova extensão
        diretorio (str): Diretório para processar
        recursivo (bool): Se deve incluir subpastas
        dry_run (bool): Se deve apenas simular
        
    Returns:
        tuple: (sucessos, falhas, total)
    """
    print(f"\nBuscando arquivos com extensão '{extensao_atual}' em '{diretorio}'...")
    if recursivo:
        print("Incluindo subpastas...")
    
    # Encontrar arquivos
    arquivos = encontrar_arquivos(diretorio, extensao_atual, recursivo)
    
    if not arquivos:
        print("Nenhum arquivo encontrado com a extensão especificada.")
        return 0, 0, 0
    
    print(f"\nEncontrados {len(arquivos)} arquivo(s):")
    for arquivo in arquivos:
        print(f"  - {arquivo}")
    
    if dry_run:
        print(f"\n[MODO SIMULAÇÃO] Os seguintes arquivos seriam renomeados:")
        for arquivo in arquivos:
            nome_base = os.path.splitext(os.path.basename(arquivo))[0]
            novo_nome = nome_base + extensao_nova
            print(f"  {os.path.basename(arquivo)} → {novo_nome}")
        return len(arquivos), 0, len(arquivos)
    
    # Confirmação do usuário
    print(f"\nDeseja renomear todos os arquivos de '{extensao_atual}' para '{extensao_nova}'?")
    confirmacao = input("Digite 'sim' para confirmar: ").strip().lower()
    
    if confirmacao not in ['sim', 's', 'yes', 'y']:
        print("Operação cancelada pelo usuário.")
        return 0, 0, len(arquivos)
    
    # Executar renomeação
    print("\nRenomeando arquivos...")
    sucessos = 0
    falhas = 0
    
    for arquivo in arquivos:
        if renomear_arquivo(arquivo, extensao_nova):
            print(f"✓ {arquivo}")
            sucessos += 1
        else:
            print(f"✗ {arquivo}")
            falhas += 1
    
    return sucessos, falhas, len(arquivos)


def modo_comando():
    """
    Processa argumentos da linha de comando e executa o modo não-interativo.
    """
    parser = argparse.ArgumentParser(
        description="Conversor de Extensões de Arquivos - Renomeia arquivos em lote",
        formatter_class=argparse.RawDescriptionHelpFormatter,
        epilog="""
Exemplos de uso:
  python convercor-extencao.py -a .txt -n .md
  python convercor-extencao.py -a jpg -n png -d /caminho/para/pasta
  python convercor-extencao.py -a .docx -n .pdf -d ./documentos -r
  python convercor-extencao.py -a .txt -n .md --dry-run
        """
    )
    
    parser.add_argument('-a', '--atual', 
                       required=True,
                       help='Extensão atual dos arquivos (ex: .txt, jpg)')
    
    parser.add_argument('-n', '--nova', 
                       required=True,
                       help='Nova extensão desejada (ex: .pdf, png)')
    
    parser.add_argument('-d', '--diretorio', 
                       default=os.getcwd(),
                       help='Diretório para processar (padrão: diretório atual)')
    
    parser.add_argument('-r', '--recursivo', 
                       action='store_true',
                       help='Incluir subpastas na busca (recursivo)')
    
    parser.add_argument('--dry-run', 
                       action='store_true',
                       help='Simular sem executar as alterações')
    
    args = parser.parse_args()
    
    # Normalizar extensões
    extensao_atual = normalizar_extensao(args.atual)
    extensao_nova = normalizar_extensao(args.nova)
    
    # Verificar se diretório existe
    if not os.path.exists(args.diretorio):
        print(f"Erro: O diretório '{args.diretorio}' não existe!")
        sys.exit(1)
    
    # Executar conversão
    sucessos, falhas, total = executar_conversao(
        extensao_atual, extensao_nova, args.diretorio, 
        args.recursivo, args.dry_run
    )
    
    # Relatório final
    print(f"\n=== Relatório Final ===")
    print(f"Arquivos renomeados com sucesso: {sucessos}")
    print(f"Falhas: {falhas}")
    print(f"Total processado: {total}")


def main():
    """
    Função principal que determina o modo de execução.
    """
    # Se há argumentos de linha de comando, usar modo comando
    if len(sys.argv) > 1:
        modo_comando()
    else:
        # Modo interativo
        try:
            extensao_atual, extensao_nova, diretorio, recursivo = obter_entrada_usuario()
            
            sucessos, falhas, total = executar_conversao(
                extensao_atual, extensao_nova, diretorio, recursivo
            )
            
            # Relatório final
            print(f"\n=== Relatório Final ===")
            print(f"Arquivos renomeados com sucesso: {sucessos}")
            print(f"Falhas: {falhas}")
            print(f"Total processado: {total}")
            
        except KeyboardInterrupt:
            print("\n\nOperação cancelada pelo usuário.")
            sys.exit(1)
        except Exception as e:
            print(f"\nErro inesperado: {e}")
            sys.exit(1)


if __name__ == "__main__":
    main()
