1. cp .env.example .env
2. composer install
3. set up your database credentials in .env
4. php artisan key:generate
7. php artisan migrate
8. php artisan passport:install (save credentials for Laravel Password Grant Client)
9. php artisan storage:link (optional for local development)
10. php artisan serve (for serverless application initialization)

php 8.1^
