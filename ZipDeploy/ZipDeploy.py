import os
import subprocess

# Lista dos diretórios fornecidos
dominios = [
    "villasboasempreendimentos.com.br",
    "extintoreslorenzi.com.br",
    "ritatrindade.com",
    "usina61.com.br",
    "valesilva.com.br",
    "ritatrindade.com.br",
    "portalnumismatica.hoogli.dev.br",
    "rbuniformes.com.br",
    "bentesbrasil.com.br",
    "quatromalhas.com.br",
    "boinacostelaria.com.br",
    "johnnydamasceno.com.br",
    "cynthia.hoogli.dev.br",
    "clinicaandros.com.br",
    "polilonas.hoogli.dev.br",
    "simpluscontabil.com.br",
    "vipsformosa.com.br",
    "mundialtelhastermicas.com.br",
    "ppem.com.br",
    "cascol.academy",
    "deboragrohs.com.br",
    "vivendoahistoria.com.br",
    "rezgatte.com.br",
    "bentesbrasil.com",
    "jgmincorporadora.com.br",
    "neuronorte.com.br",
    "sofisticattoparkhotel.com.br",
    "guinchoworker.com.br",
    "artezanesculturas.hoogli.cloud",
    "lemanth.com.br",
    "mundialtelhastermicas.com.br",
    "lummi.hoogli.cloud",
    "lepainrustique.com.br",
    "ritatrinidadespa.hoogli.dev.br",
    "ieb.hoogli.dev.br",
    "masterforttelhas.com.br",
    "crossnew.hoogli.partners",
    "age.hoogli.cloud",
    "blooim.hoogli.cloud",
    "showhouse.hoogli.cloud",
    "vioon.hoogli.cloud"
]

base_path = "/var/www" # Caminho ate o diretorio.

for dominio in dominios:
    project_path = os.path.join(base_path, dominio)

    if not os.path.isdir(project_path):
        print(f"[AVISO] Diretório não encontrado: {project_path}")
        continue

    zip_name = dominio.split(".")[0] + ".zip"
    zip_path = os.path.join(project_path, zip_name)

    print(f"[ZIPANDO] {dominio} → {zip_name}")

    try:
        subprocess.run(
            ['zip', '-r', zip_name, '.', '-x', zip_name],
            cwd=project_path,
            check=True
        )
        print(f"[OK] Criado: {zip_path}\n")
    except subprocess.CalledProcessError as e:
        print(f"[ERRO] Falha ao zipar {dominio}: {e}\n")
