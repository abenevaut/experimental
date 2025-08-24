# Laravel MCP

composer package opgginc/laravel-mcp-server experimentation.

```bash
composer require opgginc/laravel-mcp-server
php artisan vendor:publish --provider="OPGG\LaravelMcpServer\LaravelMcpServerServiceProvider"
```

## Start

```bash
docker build . -f Dockerfile.dev -t laravel-mcp --build-arg COMPOSER_HASH=dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6
docker run --rm -v ${USERPROFILE:-~}/.npmrc:/root/.npmrc -v ${USERPROFILE:-~}/.composer:/root/.composer -v .:/var/task -p 8080:8080 laravel-mcp
```

then connect to container and run `npm i` & `composer i`
