# Docker Compose PHP + MySQL Example
*A simple php+mysql server built using docker-compose*

## Dockerfile (PHP)
```dockerfile
FROM php:7.3-apache
RUN apt-get update && apt-get -y upgrade
RUN docker-php-ext-install mysqli
EXPOSE 80
```

## docker-compose.yml
```yaml
version: '3.3'
services:
    web:
        build:
            context: ./
            dockerfile: Dockerfile
        container_name: php
        depends_on:
            - db
        volumes:
            - ./public_html:/var/www/html/
        ports:
            - 8080:80
    db:
        container_name: mysql
        image: mysql:8.0
        command: --default-authentication-plugin=mysql_native_password
        restart: always
        environment:
            MYSQL_ROOT_PASSWORD: root
            MYSQL_DATABASE: test_db
            MYSQL_USER: devuser
            MYSQL_PASSWORD: devpass
        ports:
            - 6033:3306

```

## index.php (connection test)
```php
<?php

$host='db'; // Docker compose service name
$user='devuser'; // SQL env username
$pass='devpass'; // SQL env password
$db='test_db'; // SQL env db name

$conn = new mysqli($host,$user,$pass,$db);

// If there was an error connecting show error, if not then print success
if ($conn->connect_error)
    echo 'Connection Failed - ' . $conn->connect_error;
else
    echo 'Connection Successful';

?>
```