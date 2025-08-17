# Instructions du tutoriel Hunter-R

## Structure du fichier PAK
- Taille totale : 512KB (16 pages de 32KB)
- La ROM Ice Climber doit être placée dans les premières pages (pages 0 et 1)
- La lettre doit être placée à la suite de la ROM (page 2)
- Les pages restantes doivent être remplies de 0xFF

## Traitement de la ROM
1. Vérifier le header NES (16 bytes) et le retirer si présent
2. Taille finale requise : 40KB (0xA000 bytes)
3. Ajouter du padding si nécessaire
4. Diviser sur deux pages de 32KB (pages 0 et 1)

## Format de la lettre
- Placer la lettre sur la page 2 (après la ROM)
- Header Animal Crossing avec magic number "N64M"
- ID du jeu : 0x0101
- Signature Nintendo (0xC0DE)
- Message en japonais en UTF-16LE
- Code d'activation "ICE"
- Checksum à la fin

## Ordre des éléments dans le PAK
1. ROM Ice Climber partie 1 (page 0)
2. ROM Ice Climber partie 2 (page 1)
3. Lettre Animal Crossing (page 2)
4. Pages vides (pages 3-15)

## Notes importantes
- L'ordre est crucial : ROM d'abord, lettre ensuite
- La lettre doit être sur la page 2 spécifiquement
- Le checksum doit être calculé correctement
- La signature Nintendo est obligatoire
