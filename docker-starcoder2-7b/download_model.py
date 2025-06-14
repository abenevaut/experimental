import os
from huggingface_hub import snapshot_download

MODEL_DIR = "/models/starcoder2-7b"

if not os.path.exists(MODEL_DIR):
    print("📥 Téléchargement du modèle StarCoder2-7B...")
    snapshot_download(repo_id='bigcode/starcoder2-7b', local_dir=MODEL_DIR)
else:
    print("✅ Modèle déjà présent.")
