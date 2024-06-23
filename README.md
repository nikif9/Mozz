# Mozz-test-task
## устанвока
скачать все зависимости
```sh
composer install
npm install
npm run dev
```
скопировать файл .env.example и переименовать в .env
настроить файл .env
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=your_password
```
создать бд 
```sql
CREATE DATABASE blog_db;
```
сделать миграцию бд
```sh
php artisan migrate --seed
```
## запуск

```sh
php artisan serve
```
почта от админа admin@example.com пароль password
почта от модератора moderator@example.com пароль password