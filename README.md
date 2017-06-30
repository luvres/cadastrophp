# Cadastro PHP Mailer
-----
## Development Environment

### Download source
```
git clone https://github.com/luvres/cadastrophp.git
```
### Database MySQL (MariaDB)
```
docker run --name MariaDB \
-p 3308:3306 \
-e MYSQL_ROOT_PASSWORD=maria \
-d mariadb
```
```
docker exec -ti MariaDB mysql -uroot -pmaria
```

### Web Server PHP
```
docker run --rm --name Php -h php \
--link MariaDB:mariadb-host \
--link Postgres:postgres-host \
-p 800:80 \
-v $HOME/1uvr3z/cadastrophp:/var/www \
-ti izone/alpine:php
```
### Browser access
```
http://localhost:800
```
