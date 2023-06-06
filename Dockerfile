FROM php:8.1.16-apache-buster

# 빌드 변수들
ARG ARG_USER=tutoring
ARG ARG_UID=1000

# 환경 설정
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public \
  TZ=Asia/Seoul \
  LANG=ko_KR.UTF-8 \
  LC_TYPE=ko_KR.UTF-8 \
  PHP_MEMORY_LIMIT=512M \
  DOCKER_USER=${ARG_USER} \
  DOCKER_UID=${ARG_UID}

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# 새로운 패키지 버전 확인
RUN apt-get clean
RUN apt-get update
RUN apt-get install -y libzip-dev zip
RUN docker-php-ext-configure zip --with-zip
RUN docker-php-ext-install zip
RUN docker-php-ext-enable zip
RUN docker-php-ext-install pdo_mysql

RUN apt-get clean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*




# 아파치 Document root 수정
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# create system user to run Composer and Artisan commands
RUN useradd -u $DOCKER_UID -m $DOCKER_USER
RUN mkdir -p /home/$DOCKER_USER/.composer \
    && chown -R $DOCKER_USER:$DOCKER_USER /home/$DOCKER_USER
RUN usermod -G www-data -a $DOCKER_USER \
    && usermod -G root -a $DOCKER_USER

# 아파치 모듈 활성화(rewirte, headers)
RUN a2enmod rewrite
RUN a2enmod headers

# 아파치 데몬 재시작(현재 연결 유지)
RUN apache2ctl -k graceful

# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# set working directory
WORKDIR /var/www/html

USER $DOCKER_USER

COPY . .
