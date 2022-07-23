1. cp .env.example .env
2. composer install
3. set up your database credentials in .env
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed (for demo data)
7. php artisan passport:install (save credentials for Laravel Password Grant Client)
8. php artisan storage:link (optional for local development)
9. php artisan serve (for serverless application initialization)

user credentials for demo data:
username: **'test@example.com'**
password: **'111222'**

php 8.1^
