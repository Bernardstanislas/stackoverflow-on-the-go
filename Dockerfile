FROM chialab/php:7.3

WORKDIR /app
RUN composer install

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
