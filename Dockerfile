FROM php:8.2-cli

# PHP extensions
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    python3 python3-pip zip gnupg ca-certificates lsb-release \
    && docker-php-ext-install pdo_mysql mbstring zip

# Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Python packages
RUN pip3 install --break-system-packages requests matplotlib numpy openai

# Node.js & npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Workdir & copy app
WORKDIR /var/www
COPY . /var/www

# Install PHP + JS dependencies
RUN composer install --no-interaction --optimize-autoloader \
    && npm install && npm run build

# Expose và CMD
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
