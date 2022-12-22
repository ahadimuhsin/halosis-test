## Instalasi

1. Clone project ke dalam folder
2. Masuk ke dalam folder, kemudian jalankan `composer install`
3. Jalankan `cp .env.example .env` kemudian setting database yang akan digunakan
4. Jalankan `php artisan key:generate`
5. Buat database baru kemudian import file `halosis-test.sql`
6. Akses dengan `php artisan serve` atau menggunakan XAMPP/Laragon
7. Untuk melihat contoh request dan response, import file `halosis-test.postman_collection.json` ke dalam POSTMAN

## Kredensial
Default admin login:
Email : `halo@halosis.com`
Password: `password`

## Requirement
1. PHP >= 8.0.2
2. Composer 2
3. MySQL >= 5.7.33
4. NPM >= 8.19.2
