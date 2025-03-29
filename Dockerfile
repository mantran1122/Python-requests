# Sử dụng image PHP CLI vì bạn chạy artisan serve
FROM php:8.2-cli

# Cài các extension cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo_mysql mbstring zip

# Đặt thư mục làm việc mặc định
WORKDIR /var/www
