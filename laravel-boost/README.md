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
```
docker run --rm -v $(pwd):/var/task -v ${USERPROFILE:-~}/.npmrc:/root/.npmrc -v ${USERPROFILE:-~}/.composer:/root/.composer ghcr.io/abenevaut/vapor-default:php83 php /var/task/artisan boost:mcp
```
