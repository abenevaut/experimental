import os
import struct
import binascii

# Constantes
PAGE_SIZE = 0x8000  # 32KB par page
NES_HEADER_SIZE = 16  # Taille du header NES
EXPECTED_ROM_SIZE = 0xA000  # 40KB taille attendue
ROM_PAGE_1 = 0  # ROM sur la page 0
ROM_PAGE_2 = 1  # ROM sur la page 1
LETTER_PAGE = 2  # Lettre sur la page 2

def calculate_checksum(data):
    """Calcule le checksum de la lettre"""
    checksum = 0
    for i in range(0, 0x7FFC, 2):  # Calcule jusqu'à l'offset du checksum
        checksum = (checksum + struct.unpack('<H', data[i:i+2])[0]) & 0xFFFF
    return checksum

def create_empty_pak():
    """Crée un fichier .pak vide de 32KB * 16 pages"""
    return bytearray([0xFF] * (PAGE_SIZE * 16))

def create_ac_letter():
    """Crée le contenu de la lettre Animal Crossing spécifique pour Ice Climber"""
    letter = bytearray([0xFF] * PAGE_SIZE)

    # En-tête Animal Crossing
    letter[0x0:0x4] = b'N64M'     # Magic number pour le Memory Pak
    letter[0x4] = 0x00            # Version
    letter[0x5] = 0x03            # Nombre de pages utilisées (1 note + 2 pages de jeu)
    letter[0x6] = 0x00            # Reserved
    letter[0x7] = 0x00            # Reserved

    # ID du jeu et informations de la lettre
    letter[0x08:0x0A] = bytes([0x01, 0x01])  # Game ID pour Ice Climber (0x0101)
    letter[0x0A:0x0C] = bytes([0x00, 0x00])  # Type de lettre
    letter[0x0C:0x0E] = bytes([0x01, 0x00])  # Index de la lettre
    letter[0x0E:0x10] = bytes([0x00, 0x00])  # Flags

    # Date de la lettre (format Animal Crossing)
    letter[0x10:0x12] = bytes([0x14, 0x00])  # Année (20)
    letter[0x12:0x14] = bytes([0x08, 0x00])  # Mois (Août)
    letter[0x14:0x16] = bytes([0x10, 0x00])  # Jour (16)

    # Expéditeur "任天堂" en UTF-16LE
    sender = "任天堂".encode('utf-16le')
    letter[0x16:0x16 + len(sender)] = sender
    letter[0x16 + len(sender):0x26] = bytes([0x00] * (0x26 - (0x16 + len(sender))))

    # Signature Nintendo (header spécial)
    letter[0x24:0x26] = bytes([0xC0, 0xDE])  # Signature Nintendo

    # Code d'activation Ice Climber
    letter[0x26:0x28] = bytes([0x49, 0x00])  # "I"
    letter[0x28:0x2A] = bytes([0x43, 0x00])  # "C"
    letter[0x2A:0x2C] = bytes([0x45, 0x00])  # "E"
    letter[0x2C:0x2E] = bytes([0x00, 0x00])  # Null terminator

    # Corps de la lettre en UTF-16LE (texte japonais)
    message = "アイスクライマー様\n\nファミコンの\nアイスクライマーを\nお届けします。\n\n任天堂より"
    message_bytes = message.encode('utf-16le')
    letter[0x30:0x30 + len(message_bytes)] = message_bytes

    # Remplir jusqu'à l'offset du checksum avec 0xFF
    letter[0x30 + len(message_bytes):0x7FFC] = bytes([0xFF] * (0x7FFC - (0x30 + len(message_bytes))))

    # Calcul et ajout du checksum à la fin de la page
    checksum = calculate_checksum(letter)
    letter[0x7FFC:0x7FFE] = struct.pack('<H', checksum)
    letter[0x7FFE:0x8000] = bytes([0x00, 0x00])  # Termine avec 2 octets nuls

    return letter

def import_nes_rom(rom_path):
    """Importe le ROM NES et le prépare pour Animal Crossing

    1. Vérifie si le ROM a un header NES (commence par 'NES')
    2. Retire le header si présent
    3. Vérifie et ajuste la taille à 40KB exactement
    4. Divise en deux pages de 32KB
    """
    with open(rom_path, 'rb') as f:
        rom_data = f.read()

    # Vérifie et retire le header NES si présent
    if rom_data[:4].startswith(b'NES'):
        print("Header NES détecté, suppression...")
        rom_data = rom_data[NES_HEADER_SIZE:]

    # Vérifie la taille du ROM
    if len(rom_data) > EXPECTED_ROM_SIZE:
        print(f"ROM trop grand ({len(rom_data)} bytes), troncature à {EXPECTED_ROM_SIZE} bytes...")
        rom_data = rom_data[:EXPECTED_ROM_SIZE]
    elif len(rom_data) < EXPECTED_ROM_SIZE:
        print(f"ROM trop petit ({len(rom_data)} bytes), ajout de padding jusqu'à {EXPECTED_ROM_SIZE} bytes...")
        rom_data = rom_data + bytes([0xFF] * (EXPECTED_ROM_SIZE - len(rom_data)))

    # Vérifie la taille finale
    if len(rom_data) != EXPECTED_ROM_SIZE:
        raise ValueError(f"Taille du ROM incorrecte : {len(rom_data)} bytes (attendu : {EXPECTED_ROM_SIZE})")

    # Padding pour les deux pages de 32KB
    full_data = rom_data + bytes([0xFF] * (PAGE_SIZE * 2 - EXPECTED_ROM_SIZE))

    # Divise en deux pages
    page1 = full_data[:PAGE_SIZE]
    page2 = full_data[PAGE_SIZE:PAGE_SIZE*2]

    return page1, page2

def debug_dump_page(data, page_number, description):
    """Affiche les informations de débogage pour une page"""
    start = page_number * PAGE_SIZE
    end = start + PAGE_SIZE
    page_data = data[start:end]

    print(f"\n=== Page {page_number} - {description} ===")
    print(f"Premier 32 bytes:")
    print(binascii.hexlify(page_data[:32], " ").decode())
    if page_number == LETTER_PAGE:
        # Affiche les informations importantes de la lettre
        print("\nInformations de la lettre:")
        print(f"Magic Number: {page_data[0:4].decode()}")
        print(f"Version: {hex(page_data[4])}")
        print(f"Nombre de pages: {hex(page_data[5])}")
        print(f"Game ID: {hex(page_data[8])}{hex(page_data[9])[2:]}")
        print(f"Signature Nintendo: {hex(page_data[0x24])}{hex(page_data[0x25])[2:]}")
        print(f"Code ICE: {page_data[0x26:0x2C].decode('utf-16le')}")
        try:
            print(f"Checksum: {hex(struct.unpack('<H', page_data[0x7FFC:0x7FFE])[0])}")
        except:
            print("Erreur lors de la lecture du checksum")

def verify_pak_file(filepath):
    """Vérifie le contenu d'un fichier .pak existant"""
    print(f"\nVérification du fichier: {filepath}")

    with open(filepath, 'rb') as f:
        data = f.read()

    # Vérifier la taille totale
    total_size = len(data)
    expected_size = PAGE_SIZE * 16
    print(f"\nTaille totale: {total_size} bytes ({total_size/1024:.2f}KB)")
    if total_size != expected_size:
        print(f"ERREUR: Taille incorrecte. Attendu: {expected_size} bytes")

    # Vérifier le contenu des pages importantes
    debug_dump_page(data, ROM_PAGE_1, "ROM Partie 1")
    debug_dump_page(data, ROM_PAGE_2, "ROM Partie 2")
    debug_dump_page(data, LETTER_PAGE, "Lettre Animal Crossing")

def create_pak_file(nes_path, output_path):
    """Crée le fichier .pak final"""
    pak_data = create_empty_pak()

    print(f"Traitement du ROM : {nes_path}")

    # Importe et ajoute le ROM NES
    page1, page2 = import_nes_rom(nes_path)
    pak_data[ROM_PAGE_1 * PAGE_SIZE:(ROM_PAGE_1 + 1) * PAGE_SIZE] = page1
    pak_data[ROM_PAGE_2 * PAGE_SIZE:(ROM_PAGE_2 + 1) * PAGE_SIZE] = page2
    print("ROM Ice Climber intégré")

    # Ajoute la lettre Animal Crossing
    letter = create_ac_letter()
    pak_data[LETTER_PAGE * PAGE_SIZE:(LETTER_PAGE + 1) * PAGE_SIZE] = letter
    print("Lettre Animal Crossing ajoutée")

    # Écrit le fichier .pak
    with open(output_path, 'wb') as f:
        f.write(pak_data)

    print(f"\nFichier .pak créé avec succès : {output_path}")
    print("Taille totale : {} bytes ({} pages de 32KB)".format(
        len(pak_data), len(pak_data) // PAGE_SIZE
    ))

    # Vérifie le fichier créé

if __name__ == '__main__':
    # Cherche le ROM Ice Climber (préfère la version JE)
    if os.path.exists('Ice Climber (JE).nes'):
        nes_path = 'Ice Climber (JE).nes'
    elif os.path.exists('Ice Climber (U).nes'):
        nes_path = 'Ice Climber (U).nes'
    else:
        raise FileNotFoundError("ROM Ice Climber non trouvé")

    output_path = 'Doubutsu no Mori (Japan).pak'
    create_pak_file(nes_path, output_path)
