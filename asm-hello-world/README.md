# ASM Hello world

```shell
docker run --rm -v $(shell pwd):/usr/src/myapp -w /usr/src/myapp gcc:latest gcc -o hello -static -nostdlib /usr/src/myapp/main.s
```
