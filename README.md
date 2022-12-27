In order to run the project properly you need to:

run composer install
change .env.example to .env
run php artisan key:generate
configure .env
create a database with the same name as written in env
run php artisan migrate:fresh --seed
run php artisan serve