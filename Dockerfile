FROM php:8.2.9RC1-apache-bullseye

# 환경 설정
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public \
  TZ=Asia/Seoul \
  LANG=ko_KR.UTF-8 \
  LC_TYPE=ko_KR.UTF-8 \
  PHP_MEMORY_LIMIT=512M
ARG XDEBUG_IDEKEY=PHPSTORM
ARG XDEBUG_REMOTE_PORT=9000

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# 새로운 패키지 버전 확인
RUN apt-get clean
RUN apt-get update --fix-missing
RUN apt-get upgrade -y --allow-unauthenticated

RUN apt-get install -y libzip-dev zip \
  && docker-php-ext-configure zip --with-zip \
  && docker-php-ext-install zip \
  && docker-php-ext-install pdo_mysql \
  && docker-php-ext-configure sysvsem --enable-sysvsem \
  && docker-php-ext-install sysvsem

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

RUN echo "xdebug.log=/tmp/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=$XDEBUG_IDEKEY" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=$XDEBUG_REMOTE_PORT" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=trigger" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN pecl install sync \
  && docker-php-ext-enable sync

RUN apt-get clean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# 아파치 Document root 수정
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 아파치 모듈 활성화(rewirte, headers)
RUN a2enmod rewrite
RUN a2enmod headers

# 아파치 데몬 재시작(현재 연결 유지)
RUN apache2ctl -k graceful

# install composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
