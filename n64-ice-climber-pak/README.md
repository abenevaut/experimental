# Ice Climber NES vers N64 Controller Pak

Ce projet permet de créer un fichier `.pak` pour N64 Controller Pak contenant le jeu Ice Climber NES, accessible via Doubutsu no Mori (Animal Crossing japonais).

- [based on "hunter-r.com, ice-climber-pak" project](https://hunter-r.com/posts/ice-climber-pak/)

## Prérequis

- Python 3.x
- ROM Ice Climber NES (version JE ou U)
  - Taille attendue : 40KB (après retrait du header)
  - Le header NES (16 bytes) sera automatiquement retiré si présent
- Doubutsu no Mori (version japonaise d'Animal Crossing N64)

## Description

Le script Python `create_pak.py` crée un fichier `.pak` qui :
- Traite le ROM NES pour le rendre compatible avec l'émulateur NES d'Animal Crossing
- Place le ROM sur les pages 0-1 du Controller Pak
- Ajoute la lettre formatée sur la page 2
- Est compatible avec l'émulation et le hardware original

## Spécifications Techniques

### Structure du fichier .pak

Le fichier .pak généré (32KB × 16 pages = 512KB) a une structure précise et ordonnée :
1. Pages 0-1 : ROM Ice Climber (40KB + padding)
2. Page 2 : Lettre formatée (32KB)
3. Pages 3-15 : Pages vides (0xFF)

L'ordre des éléments est crucial pour le fonctionnement dans Animal Crossing.

### Traitement du ROM NES

Le script effectue les opérations suivantes sur le ROM :
1. Détection et suppression du header NES (16 bytes) si présent
2. Vérification de la taille :
   - Taille cible : 40KB (0xA000 bytes)
   - Troncature si trop grand
   - Padding avec 0xFF si trop petit
3. Répartition sur deux pages de 32KB :
   - Premier 32KB sur la page 0
   - Reste + padding sur la page 1

### Format de la lettre (Page 2)

Structure détaillée de la lettre :

```
Offset  | Taille | Description
--------|---------|-------------
0x0000  | 4      | Magic "N64M"
0x0004  | 1      | Version (0x00)
0x0005  | 1      | Nombre de pages (0x03)
0x0006  | 2      | Reserved (0x0000)
0x0008  | 2      | Game ID (0x0101)
0x000A  | 2      | Type de lettre (0x0000)
0x000C  | 2      | Index de lettre (0x0001)
0x000E  | 2      | Flags (0x0000)
0x0010  | 2      | Année (0x0014 = 20)
0x0012  | 2      | Mois (0x0008 = Août)
0x0014  | 2      | Jour (0x0010 = 16)
0x0016  | 14     | Expéditeur "任天堂" (Nintendo)
0x0024  | 2      | Signature Nintendo (0xC0DE)
0x0026  | 8      | Code "ICE" + null
0x0030  | *      | Corps du message
0x7FFC  | 2      | Checksum
0x7FFE  | 2      | Null terminator
```

### Message de la lettre

Le message en japonais :
```
アイスクライマー様

ファミコンの
アイスクライマーを
お届けします。

任天堂より
```

## Utilisation

1. Placez les fichiers requis dans le même dossier :
   - `create_pak.py` (le script)
   - `Ice Climber (JE).nes` ou `Ice Climber (U).nes` (le ROM)

2. Exécutez le script :
```bash
python3 create_pak.py
```

3. Le script va :
   - Détecter et traiter le ROM NES
   - Placer le ROM sur les pages 0-1
   - Ajouter la lettre sur la page 2
   - Générer le fichier `Doubutsu no Mori (Japan).pak`

4. Installation sur N64 :
   - Copiez le fichier .pak sur votre Controller Pak N64
   - OU placez-le avec votre sauvegarde Doubutsu no Mori pour l'émulation

5. Dans le jeu :
   - Lancez Doubutsu no Mori
   - Vérifiez votre boîte aux lettres
   - Lisez la lettre de Nintendo (任天堂)
   - Le jeu Ice Climber sera débloqué

## Compatibilité

- ✅ Doubutsu no Mori (version japonaise originale)
- ✅ Hardware N64 original avec Controller Pak
- ✅ Émulateurs N64 supportant les Controller Pak
- ❌ Animal Crossing (versions internationales)

## Notes importantes

- L'ordre des éléments est crucial : ROM sur pages 0-1, lettre sur page 2
- Le format de la lettre doit être exactement respecté
- Le checksum est crucial pour la validation de la lettre
- La taille du ROM NES doit être exactement de 40KB après traitement
- La signature Nintendo (0xC0DE) est nécessaire pour l'authentification
- Seule la version japonaise (Doubutsu no Mori) est compatible

## Dépannage

Si le jeu ne fonctionne pas dans Animal Crossing :
1. Vérifiez que vous utilisez bien Doubutsu no Mori (version japonaise)
2. Assurez-vous que le ROM original fait 40KB (après retrait du header)
3. Vérifiez que la ROM est bien placée sur les pages 0-1
4. Confirmez que la lettre est sur la page 2
5. Vérifiez que le fichier .pak est bien dans le même dossier que votre sauvegarde
6. Confirmez que la lettre apparaît dans votre boîte aux lettres

## Build

/!\ Project WIP

```shell
cd ice-climber-nes-n64-animal-crossing-doubutsu-no-mori-controller-pak
python3 create_pak.py
```

Then start [ares]() with `ice-climber-nes-n64-animal-crossing-doubutsu-no-mori-controller-pak/Doubutsu no Mori (Japan).z64` game.
