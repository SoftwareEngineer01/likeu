## CLONAR PROYECTO
git clone https://github.com/SoftwareEngineer01/likeu.git

## INSTALAR COMPOSER
composer install

## CREAR ARCHIVO .env
cp .env.example .env

## CONFIGURAR ARCHIVO .env
* DB_CONNECTION=mysql
* DB_HOST=ip host
* DB_PORT=3306
* DB_DATABASE=name database
* DB_USERNAME=user database
* DB_PASSWORD=password database

## CREAR LA KEY EN EL ARCHIVO .env
php artisan key:generate

## CREAR LA SECRET KEY JWT
php artisan jwt:secret

## MIGRAR BASE DE DATOS
php artisan migrate

## EJECUTAR LOS SEEDERS
php artisan db:seed

## EJECUTAR SERVIDOR
php artisan serve

## LINK DOCUMENTACION SWAGGER
* http://localhost:8000/api/documentation

## CREDENCIALES - INICIAR SESION EN EL ITEM DE LOGIN - SWAGGER
* email : admin@admin.com
* password : 123456

## REALIZAR LAS DEMAS PETICIONES
* Despues de hacer login, para desbloquear las otras peticiones seleccionar el boton Authorize
* Escribir Bearer y el token generado al realizar login
* Ejemplo: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHR
* Boton Authorize

