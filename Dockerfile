FROM php:7.2-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl git zip unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
COPY . /app
RUN cp /app/.env.docker /app/.env
RUN composer install
CMD php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000
