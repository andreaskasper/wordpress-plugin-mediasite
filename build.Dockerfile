FROM php:8-cli

#install some base extensions
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        zip \
    && docker-php-ext-install zip \
    && apt-get clean

WORKDIR /app/

ENTRYPOINT ["php"]
CMD ["build.php"]