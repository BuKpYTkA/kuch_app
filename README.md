1. cp .env.example .env
2. set up your database credentials in .env
3. php artisan key:generate
4. composer install
5. php artisan vendor:publish --all
6. php artisan migrate
7. php artisan passport:install (save credentials for Laravel Password Grant Client)
8. php artisan storage:link (optional for local development)
9. php artisan serve (for serverless application initialization)
