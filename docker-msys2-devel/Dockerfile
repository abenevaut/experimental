# docker build -t abenevaut/msys2-devel:latest .
# docker run -it abenevaut/msys2-devel:latest

# docker build --build-arg MSYS2_TAG=latest-w10 -t abenevaut/msys2-devel:latest-w10 .
# docker run -it abenevaut/msys2-devel:latest-w10

ARG MSYS2_TAG=latest

FROM abenevaut/msys2:$MSYS2_TAG

LABEL maintainer="Antoine Benevaut <me@abenevaut.dev>"

RUN bash -l -c "pacman -S git base-devel msys2-devel --needed --noconfirm --noprogressbar"

RUN bash -l -c "pacman -S mingw-w64-{i686,x86_64}-toolchain mingw-w64-{i686,x86_64}-clang --needed --noconfirm --noprogressbar"

RUN bash -l -c "pacman -S mingw-w64-{i686,x86_64}-7zip mingw-w64-{i686,x86_64}-cmake --needed --noconfirm --noprogressbar"
