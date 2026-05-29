FROM php:7.4-apache

RUN a2enmod rewrite

# Install dependencies
RUN apt-get update && \
  apt-get install -y --no-install-recommends \
  openssl \
  apache2-bin \
  && rm -rf /var/lib/apt/lists/*

# Enable SSL mode
RUN a2enmod ssl && \
  a2ensite default-ssl

# Copy certificate SSL
COPY docker/ssl/localhost.crt /etc/ssl/certs/
COPY docker/ssl/localhost.key /etc/ssl/private/

# Copy file cấu hình
COPY docker/apache/default-ssl.conf /etc/apache2/sites-available/
COPY docker/apache/000-default.conf /etc/apache2/sites-available/

# Add installer
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN install-php-extensions curl mbstring mysqli pdo_mysql zip exif intl fileinfo imagick ldap apcu apcu_bc gd

# Khởi động Apache khi container chạy
CMD ["apache2-foreground"]

EXPOSE 80 443