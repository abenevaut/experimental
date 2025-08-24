# docker build -m 2GB -t abenevaut/msys2-php-devel:latest .
# docker run -it abenevaut/msys2-php-devel:latest

# docker build -m 2GB --build-arg MSYS2_TAG=latest-w10 -t abenevaut/msys2-php-devel:latest-w10 .
# docker run -it abenevaut/msys2-php-devel:latest-w10

ARG MSYS2_TAG=latest

FROM abenevaut/msys2-devel:$MSYS2_TAG

LABEL maintainer="Antoine Benevaut <me@abenevaut.dev>"

RUN wget -O php-sdk-binary-tools.zip https://github.com/php/php-sdk-binary-tools/archive/refs/tags/php-sdk-2.2.0.zip \
    && bash -l -c "/mingw64/bin/7z x php-sdk-binary-tools.zip -oC:\\" \
    && setx /M path "%PATH%;C:\php-sdk-binary-tools-php-sdk-2.2.0\;"

RUN wget -O vs_buildtools.exe https://aka.ms/vs/17/release/vs_buildtools.exe \
    && (start /w vs_buildtools.exe --passive --wait --norestart --nocache \
        --installPath "%ProgramFiles%\Microsoft Visual Studio\2022\BuildTools" \
        --add Microsoft.VisualStudio.Workload.VCTools \
        --add Microsoft.VisualStudio.Component.VC.Redist.14.Latest \
        || IF "%ERRORLEVEL%"=="3010" EXIT 0) \
    && del /q vs_buildtools.exe \
