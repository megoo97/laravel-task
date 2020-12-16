
# Laravel7 


## To Start The Project
```
$ docker-compose up -d --build
```

## web-app
```
$ docker-compose exec web-app composer install
$ docker-compose exec web-app cp .env.example .env
$ docker-compose exec web-app php artisan key:generate
$ docker-compose exec web-app php artisan migrate
$ docker-compose exec web-app php artisan db:seed --class=NewsSeeder
$ docker-compose exec web-app php artisan db:seed --class=UsersTableSeeder
$ docker-compose exec web-app php artisan db:seed --class=AgenciesSeeder

```
## To build the vue

$ docker-compose run node npm install
$ docker-compose run node npm run dev
```

