# Sử dụng image PHP CLI vì bạn chạy artisan serve
FROM php:8.2-cli

# Cài các extension cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    python3 \
    python3-pip \
    zip \
    gnupg \
    ca-certificates \
    lsb-release \
    && docker-php-ext-install pdo_mysql mbstring zip

# ✨ Cài Python packages kèm --break-system-packages để tránh lỗi
RUN pip3 install --break-system-packages requests matplotlib numpy openai

# Cài Node.js + npm (phiên bản ổn định)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Kiểm tra phiên bản để xác nhận cài thành công
RUN node -v && npm -v

# Thư mục làm việc
WORKDIR /var/www
