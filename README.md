In order to run the project properly you need to:

1. run composer install
2. change .env.example to .env
3. run php artisan key:generate
4. configure .env
5. create a database with the same name as written in env
6. run php artisan migrate:fresh --seed
7. run php artisan serve
