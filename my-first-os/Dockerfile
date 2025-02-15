#
# docker build -t compil-os .
# docker run -it --rm -v .:/vol  compil-os /bin/sh
# docker run -it --rm -v .:/vol  compil-os cp bootloader.iso /vol
# drutil burn bootloader.iso
#
# docker run -it --rm -v ./bootloader.iso:/boot.iso qemux/qemu-docker
# NOT WORKING : docker run -it --rm -e "BOOT=https://github.com/abenevaut/experimental/actions/runs/13344411687/artifacts/2596859166" qemux/qemu-docker
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
