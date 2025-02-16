.global _start
.section .text

_start:
    mov $1, %rax
    mov $1, %rdi
    mov $message, %rsi
    mov $13, %rdx
    syscall

    mov $60, %rax
    mov $0, %rdi
    syscall

message:
    .ascii "Hello, World!\n"
