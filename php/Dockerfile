FROM php:8.0-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql && \
  apk add --update nodejs npm 

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo pdo_mysql && \
  apk add --update nodejs npm 

COPY --from=composer /usr/bin/composer /usr/bin/composer

# WORKDIR /var/www/html
# RUN cd /var/www/html
# RUN composer require laravel/ui --dev
# RUN php artisan ui vue
# RUN npm install
# RUN npm install vue-router
# RUN npm install vuex
# example.envをコピーして.envファイルを作成
# npm installの後にnode_modulesとpakage.lockを削除後もう一回npm installしないとエラーが出る

# /var/www/html # php artisan tinker
# Psy Shell v0.10.8 (PHP 8.0.11 — cli) by Justin Hileman
# >>> $category = App\Models\Category::factory()->make();