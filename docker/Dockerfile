FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y git 

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql 
#RUN docker-php-ext-install sqlsrv pdo_sqlsrv

RUN apt-get install -y libpq-dev 
RUN docker-php-ext-install -j$(nproc) pdo_pgsql

RUN apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install zip

RUN apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Install Imagick
RUN apt-get install -y libmagickwand-dev
RUN pecl install imagick
RUN docker-php-ext-enable imagick

ENV ACCEPT_EULA=Y

RUN apt-get update && apt-get install -y gnupg2
#RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
RUN curl -sS https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor | tee /etc/apt/trusted.gpg.d/microsoft.gpg
RUN curl https://packages.microsoft.com/config/debian/11/prod.list > /etc/apt/sources.list.d/mssql-release.list
RUN apt-get update
RUN apt-get install -y msodbcsql18
RUN apt-get install -y mssql-tools18
RUN apt-get install -y unixodbc-dev
RUN apt-get install -y libgssapi-krb5-2
RUN pecl install sqlsrv
RUN pecl install pdo_sqlsrv
RUN docker-php-ext-enable sqlsrv pdo_sqlsrv

# ✅ Install Node.js (LTS version)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Check versions
RUN php -v && node -v && npm -v

# Get latest Composer
#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Set working directory
WORKDIR /var/www/public
