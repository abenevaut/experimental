# laravel boost

```
composer require laravel/boost --dev
```

```
php artisan boost:install
```

```
php /var/task/artisan boost:mcp
```

```json
{
    "servers": {
        "laravel-boost": {
            "command": "php",
            "args": [
                "/var/task/artisan",
                "boost:mcp"
            ]
        }
    }
}
```


```
docker build . -f Dockerfile.dev -t laravel-boost --build-arg COMPOSER_HASH=dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6
docker run --name=lboost -v ${USERPROFILE:-~}/.npmrc:/root/.npmrc -v ${USERPROFILE:-~}/.composer:/root/.composer -v .:/var/task -p 8080:8080 -p 5173:5173 laravel-boost
docker exec -i lboost php artisan boost:mcp
```

`mcp.json`
```json
{
    "servers": {
      "laravel-boost": {
        "command": "docker",
        "args": [
          "exec",
          "-i",
          "lboost",
          "php",
          "artisan",
          "boost:mcp"
        ]
      }
    }
}
```
