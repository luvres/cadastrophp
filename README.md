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

```
DROP DATABASE IF EXISTS `db_usuarios`;
CREATE DATABASE IF NOT EXISTS `db_usuarios`;
USE `db_usuarios`

CREATE TABLE `hash_confirmacao` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `hash` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_cadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DESCRIBE hash_confirmacao;
SELECT * FROM hash_confirmacao;

CREATE TABLE `usuario` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `login` varchar(20) UNIQUE NOT NULL,
  `senha` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `data_cadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DESCRIBE usuario;
SELECT * FROM usuario;
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
