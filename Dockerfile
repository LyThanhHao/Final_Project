# Chọn PHP chính thức có Composer
FROM php:7.4-fpm

# Cài đặt các package cần thiết
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev nodejs npm

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Sao chép mã nguồn vào thư mục ứng dụng
COPY . /app
WORKDIR /app

# Cài đặt package từ Composer và NPM
RUN composer install --no-dev --optimize-autoloader
RUN npm install --production

# Thiết lập quyền cho các thư mục lưu trữ tạm thời
RUN chmod -R 775 storage bootstrap/cache

# Expose port 8000 for the PHP built-in server
EXPOSE 8000
