# My First OS

![demo](https://raw.githubusercontent.com/abenevaut/experimental/refs/heads/master/my-first-os/my-first-os.png)

Inspired by this video on [ytb (screw it... let's recode Windows from scratch)](https://www.youtube.com/watch?v=ELTwwTsR5w8&t=1016s),
I decided to create my own OS from scratch, to try...

```shell
docker build -t compil-os .
docker run --rm -v .:/vol  compil-os cp bootloader.iso /vol
```

Try it with qemu or virtualbox.

```shell
docker run -it --rm -v ./bootloader.iso:/boot.iso qemux/qemu-docker
```
