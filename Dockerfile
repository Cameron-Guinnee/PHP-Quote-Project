FROM php:8.2-apache
# This is essential since it installs a number of different system packages and dependencies. 
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/* 
WORKDIR /var/www/html 
COPY . /var/www/html
# This is for PostgreSQL support
RUN docker-php-ext-install pdo_pgsql
COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
# This is needed in order to deploy on render.com; if testing the web app locally, it can be commented out.
RUN echo "Listen 0.0.0.0:80" >> /etc/apache2/apache2.conf
#    The necessary environmental variables are defined on render.com, so we don't need to set anything here.
#  Though, even if that weren't the case, it'd probably be ill-advised to leave any secrets in the published code anyway. 
EXPOSE 80

