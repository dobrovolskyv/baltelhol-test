# Используем официальный образ PHP с FPM
FROM php:8.3-fpm

# Устанавливаем системные зависимости и PostgreSQL драйвер
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    curl \
    git \
    && docker-php-ext-install pdo_pgsql

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем Node.js 22 (нужен для Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Копируем файлы проекта
COPY . .

# Устанавливаем PHP зависимости
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Устанавливаем Node зависимости и собираем фронт
RUN npm install && npm run build

# Настройки прав
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

# Команда запуска
CMD ["php-fpm"]
