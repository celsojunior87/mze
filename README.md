## Instalação

```sh
composer install
```

copiar .env.example para .env e configurar

```sh
php artisan migrate:fresh --seed
php artisan passport:install
php artisan storage:link
```
