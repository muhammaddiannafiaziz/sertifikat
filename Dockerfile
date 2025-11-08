# Simpan sebagai: Dockerfile
FROM php:8.2-fpm-alpine

# Setel direktori kerja
WORKDIR /var/www/html

# Instal ekstensi PHP yang umum
# pdo_mysql : untuk koneksi ke database
# gd        : untuk memanipulasi gambar (sering dipakai untuk generate sertifikat/PDF)
RUN apk add --no-cache \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql

# Instal Composer (Manajer paket PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer