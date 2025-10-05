# 🧭 HƯỚNG DẪN CẤU HÌNH LOCALHOST CHO DỰ ÁN LARAVEL

## 1️⃣ Yêu cầu hệ thống

Máy chủ cần có: - **Apache:** 2.4.54 (Win64) - **PHP:** 8.3.22 -
**MySQL:** 8.0.3 - **Composer:** 2.8.10 - **Laravel Framework:**
10.48.29

> ⚠️ Khuyến nghị sử dụng **Laragon** hoặc **XAMPP** để dễ dàng cấu hình
> Apache, PHP và MySQL.

---

## 2️⃣ Cấu hình Apache

Mở file cấu hình Apache (thường là:\
➡️ `C:\laragon\bin\apache\httpd-2.4.54\conf\httpd.conf`\
hoặc\
➡️ `C:\xampp\apache\conf\httpd.conf`)

Tìm và bỏ comment (xóa dấu `#`) các dòng sau:

```apache
LoadModule rewrite_module modules/mod_rewrite.so
```

Tìm phần `<Directory "C:/laragon/www">` (hoặc thư mục chứa dự án)\
và chỉnh lại:

```apache
<Directory "C:/laragon/www">
    AllowOverride All
    Require all granted
</Directory>
```

> ✅ Mục đích: Cho phép Laravel sử dụng `.htaccess` để rewrite URL.

---

## 3️⃣ Cấu hình PHP

Kiểm tra file `php.ini` (đường dẫn:
`C:\laragon\bin\php\php-8.3.22\php.ini`)\
Bật (bỏ dấu `;`) các extension cần thiết cho Laravel:

```ini
extension=fileinfo
extension=openssl
extension=pdo_mysql
extension=mbstring
extension=tokenizer
extension=curl
extension=intl
extension=bcmath
```

Khởi động lại Apache sau khi thay đổi.

---

## 4️⃣ Cấu hình MySQL

Đăng nhập phpMyAdmin hoặc MySQL Command Line và tạo database:

```sql
CREATE DATABASE ten_database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

> ⚠️ Ghi nhớ tên database, user, password để cấu hình vào `.env`.

---

## 5️⃣ Cài đặt Composer

Kiểm tra Composer đã cài đặt:

```bash
composer -V
```

Kết quả mong đợi:

    Composer version 2.8.10

Nếu chưa, tải tại <https://getcomposer.org/download/>

---

## 6️⃣ Cấu hình Laravel

### a. Cài đặt thư viện

```bash
composer install
```

### b. Tạo file `.env`

```bash
cp .env.example .env
```

### c. Cấu hình `.env`

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://ten_du_an.test

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ten_database
DB_USERNAME=root
DB_PASSWORD=
```

---

## 7️⃣ Tạo key và cache cấu hình

```bash
php artisan key:generate
php artisan config:cache
```

---

## 8️⃣ Chạy dự án

**Cách 1:** Dùng built-in server

```bash
php artisan serve
```

**Cách 2:** Dùng Apache (Laragon/XAMPP)\
Đặt dự án trong:

    C:\laragon\www

hoặc

    C:\xampp\htdocs

Truy cập:

    http://ten_du_an.test

---

## 9️⃣ Kiểm tra phiên bản

```bash
php -v
mysql -V
composer -V
php artisan --version
```

---

## 🔟 Các lỗi thường gặp

---

Lỗi Nguyên nhân Cách khắc phục

---

500 Internal mod_rewrite chưa bật Bật rewrite_module trong Apache
Server Error

"Could not extension `pdo_mysql` chưa Bật trong php.ini
find driver" bật

"Access denied Sai DB_USERNAME hoặc Kiểm tra `.env`
for user" DB_PASSWORD

"Application Chưa tạo APP_KEY Chạy `php artisan key:generate`
key not set"

---

---

## ✅ Kết luận

Sau khi hoàn tất, môi trường local Laravel sẽ bao gồm: - Apache 2.4.54\

-   PHP 8.3.22\
-   MySQL 8.0.3\
-   Composer 2.8.10\
-   Laravel 10.48.29
