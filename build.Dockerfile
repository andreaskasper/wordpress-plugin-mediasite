FROM php:8-cli

LABEL org.opencontainers.image.authors="Andreas.Kasper@goo1.de"

#install some base extensions
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        zip \
        curl \
    && docker-php-ext-install zip \
    && apt-get clean \
    && curl -LsS https://codeception.com/php80/codecept.phar -o /usr/local/bin/codecept \
    && chmod a+x /usr/local/bin/codecept

WORKDIR /app/

ENTRYPOINT ["php"]
CMD ["build.php"]