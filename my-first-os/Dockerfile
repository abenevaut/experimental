#
# docker build -t compil-os .
# docker run -it --rm -v .:/vol  compil-os /bin/sh
# cp bootloader.iso /vol
#
FROM debian:latest AS builder
RUN apt-get update && apt-get install -y nasm xorriso
WORKDIR /build
COPY bootloader.asm binary.asm ./

# Compilation
RUN nasm -f bin bootloader.asm -o bootloader.bin && \
    nasm -f bin binary.asm -o binary.bin && \
    dd if=/dev/zero of=bootloader.img bs=512 count=2880 && \
    dd if=bootloader.bin of=bootloader.img conv=notrunc && \
    dd if=binary.bin of=bootloader.img seek=1 conv=notrunc

# Création de l'ISO sans GRUB
RUN xorriso -as mkisofs -b bootloader.img -o bootloader.iso bootloader.img

CMD ["/bin/sh"]
