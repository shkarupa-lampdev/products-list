## Install project (Dev)

1. Run `git clone https://github.com/shkarupa-lampdev/products-list.git`, to clone the repository.
2. Copy file `.env.example` and rename to `.env`. May be done by running `cp .env.example .env`.
3. Run `docker compose up -d --build`.
5. Run `php artisan key:generate` to generate key.
6. Run `php artisan migrate --seed`, to run migrations and create a test user.
Param -seed because it creates test user with email `test@example.com` and password `password`.
7. Run `php artisan serve`.
8. Open http://127.0.0.1:8000/.
9. Log in using credentials (`test@example.com` and `password`).
10. On /dashboard you can see table that will contain products as soon as DB is populated.
11. Run `php artisan schedule:work`, so every 2 hours 3 requests will be send to DummyJson
    to retrieve 10 records per request. Only unique records will be added to DB to prevent
    duplication. In case you want to receive data more often you may change `everyTwoHours`
    to `everyMinute` in `app\Console\Kernel.php`.
12. When command was triggered which can be seen in console you may check DB and `/dashboard`.
    Records in table will be paginated 5 per page and display data for each column.
