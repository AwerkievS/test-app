###### запуск первый запуск проекта 

`cp .env.example .env`

`docker-compose up -d`

`docker-compose exec app composer install`

`docker-compose exec app artisan migrate`

`docker-compose exec app artisan db:seed`

`docker-compose exec app artisan key:generate`


Доступен по http://localhost:9999/

Авторизация 

Заголовок Authorization с токеном Bearer token

Получить можно отправив POST запрос на api/login 
`

{

"email" : "test@gmail.com",
"password" : "admin"

}

`
стандартный пользователь из сида
