; binaire.asm - Programme secondaire affichant "Hello, World!"
BITS 16
ORG 0x7E00

hello_start:
    mov si, hello_msg
    call print_string
    jmp $

hello_msg db 'Hello, World!', 0

print_string:
    lodsb
    or al, al
    jz done
    mov ah, 0x0E
    int 0x10
    jmp print_string
done:
    ret
