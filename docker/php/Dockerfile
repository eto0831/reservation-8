FROM php:7.4.9-fpm

# 必要なツールと拡張機能をインストール
RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip libpng-dev tzdata cron \
  && docker-php-ext-install pdo_mysql zip gd

# Composerをインストール
RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer

# タイムゾーン設定
ENV TZ=Asia/Tokyo

# 作業ディレクトリ
WORKDIR /var/www

# SupervisorやScheduler関連の設定は削除
