; bootloader.asm - Bootloader minimaliste
BITS 16
ORG 0x7C00

start:
    mov si, msg
    call print_string

    ; Charger le programme secondaire en mémoire (Lecture depuis le disque)
    mov ax, 0x0000  ; Segment destination
    mov es, ax
    mov bx, 0x7E00  ; Adresse mémoire du programme secondaire
    mov ah, 0x02    ; Fonction BIOS pour lire depuis le disque
    mov al, 1       ; Lire 1 secteur
    mov ch, 0       ; Cylindre 0

    ;mov cl, 1  ; Secteur 1 (boucle sur le bootloader)
    mov cl, 2       ; Secteur 2 (après le bootloader)

    mov dh, 0       ; Tête 0

    ; mov dl, 0x80    ; Premier disque dur
    mov dl, 0x00  ; Premier lecteur de disquettes

    int 0x13        ; Appel BIOS
    jc disk_error   ; Gérer une erreur de lecture

    jmp 0x0000:0x7E00  ; Sauter vers le programme secondaire

disk_error:
    mov si, err_msg
    call print_string
    jmp $

print_string:
    lodsb
    or al, al
    jz done
    mov ah, 0x0E
    int 0x10
    jmp print_string
done:
    ret

msg db 'Booting...', 0
err_msg db 'Disk read error!', 0

times 510-($-$$) db 0  ; Remplissage pour atteindre 510 octets
DW 0xAA55              ; Signature de boot
