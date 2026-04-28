#!/bin/sh
set -e

# Переходим в рабочую директорию
cd /var/www

echo "Starting initialization..."

# Создаем .env, если его нет
if [ ! -f .env ]; then
    echo "Creating .env from .env.example..."
    cp .env.example .env
fi

# Устанавливаем зависимости Composer
if [ ! -d "vendor" ] || [ -z "$(ls -A vendor 2>/dev/null)" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-interaction --optimize-autoloader
fi

# Устанавливаем зависимости NPM и собираем фронт
if [ ! -d "node_modules" ] || [ ! -d "public/build" ]; then
    echo "Installing NPM dependencies and building assets..."
    npm install
    npm run build
fi

# Генерируем ключ приложения
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generating app key..."
    php artisan key:generate --force
fi

# Права на папки (может выдавать ошибки на некоторых файловых системах, поэтому || true)
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache 2>/dev/null || true
chmod -R 775 /var/www/storage /var/www/bootstrap/cache 2>/dev/null || true

# Ждем базу данных
echo "Waiting for database to be ready..."
RETRIES=30
until php artisan db:monitor > /dev/null 2>&1 || [ $RETRIES -eq 0 ]; do
  echo "Waiting for PostgreSQL connection, $((RETRIES--)) remaining attempts..."
  sleep 2
done

if [ $RETRIES -eq 0 ]; then
    echo "Database connection failed! Proceeding anyway, but migrations might fail."
fi

# Выполняем миграции и сидирование (база будет заполнена тестовыми данными)
echo "Running migrations and seeders..."
php artisan migrate:fresh --seed --force

echo "Initialization complete! Starting PHP-FPM..."
exec "$@"
