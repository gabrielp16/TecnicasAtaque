-- DROP DATABASE `tecnicas_ataque`; 
CREATE DATABASE `tecnicas_ataque`; 

USE `tecnicas_ataque`; 

CREATE TABLE `users` 
  ( 
     `id`       INT (11) NOT NULL auto_increment, 
     `name`     VARCHAR (100) NOT NULL, 
     `email`    VARCHAR (100) NOT NULL, 
     `username` VARCHAR (100) NOT NULL, 
     `pass`     VARCHAR (100) NOT NULL, 
     `role`     VARCHAR (100) NOT NULL, 
     `active`   BIT, 
     PRIMARY KEY (`id`) 
  ) 
engine = innodb; 

INSERT INTO users 
            (`name`, 
             `email`, 
             `username`, 
             `pass`, 
             `role`, 
             `active`) 
VALUES      ( 'Gabriel Pena', 
              'gabriel.p16@gmail.com', 
              'gabo', 
              Md5('123'), 
              'administrador', 
              1 ); 

INSERT INTO users 
            (`name`, 
             `email`, 
             `username`, 
             `pass`, 
             `role`, 
             `active`) 
VALUES      ( 'Daniel Perez', 
              'daniel@gmail.com', 
              'dani', 
              Md5('123'), 
              'cliente', 
              1 ); 

CREATE TABLE `products` 
  ( 
     `id`       INT (11) NOT NULL auto_increment, 
     `name`     VARCHAR (100) NOT NULL, 
     `qty`      INT (5) NOT NULL, 
     `price`    INT (10) NOT NULL,
     `expiration_date`     VARCHAR (100) NOT NULL, 
     `users_id` INT (11) NOT NULL, 
     PRIMARY KEY (`id`), 
     CONSTRAINT fk_products_1 FOREIGN KEY (users_id) REFERENCES users (id) 
  ) 
engine = innodb; 

INSERT INTO products 
            (`name`, 
             `qty`, 
             `price`, 
             `expiration_date`,
             `users_id`) 
VALUES      ( 'Producto 1', 
              100, 
              2000,
              '2020-10-20',
              1 ); 

INSERT INTO products 
            (`name`, 
             `qty`, 
             `price`, 
             `expiration_date`,
             `users_id`) 
VALUES      ( 'Producto 2', 
              150, 
              3000,
              '2020-10-20',
              1 ); 

CREATE TABLE `roles` 
  ( 
     `id`   INT (11) NOT NULL auto_increment, 
     `name` VARCHAR (100) NOT NULL, 
     PRIMARY KEY (`id`) 
  ) 
engine = innodb; 

INSERT INTO roles 
            (`name`) 
VALUES      ( 'administrador' ); 

INSERT INTO roles 
            (`name`) 
VALUES      ( 'cliente' ); 

CREATE TABLE `users_roles` 
  ( 
     `role_id`  INT (11) NOT NULL, 
     `users_id` INT (11) NOT NULL, 
     CONSTRAINT fk_users_roles_1 FOREIGN KEY (role_id) REFERENCES roles (id), 
     CONSTRAINT fk_users_roles_2 FOREIGN KEY (users_id) REFERENCES users (id) 
  ) 
engine = innodb; 

INSERT INTO users_roles 
            (`role_id`, 
             `users_id`) 
VALUES      ( 1, 
              1 ); 

INSERT INTO users_roles 
            (`role_id`, 
             `users_id`) 
VALUES      ( 2, 
              2 ); 

CREATE TABLE `audit_process_tracking` 
  ( 
     `id`          INT (11) NOT NULL auto_increment, 
     `action`      VARCHAR (100) NOT NULL, 
     `date`        TIMESTAMP NOT NULL, 
     `user_id`     INT (11) NOT NULL, 
     `description` VARCHAR (200) NOT NULL, 
     PRIMARY KEY (`id`), 
     CONSTRAINT fk_audit_process_tracking_1 FOREIGN KEY (user_id) REFERENCES 
     users (id) 
  ) 
engine = innodb; 

INSERT INTO audit_process_tracking 
            (`action`, 
             `date`, 
             `user_id`, 
             `description`) 
VALUES      ( 'Add service', 
              CURRENT_TIMESTAMP, 
              1, 
              'Se agregó Producto: Producto 1' ); 

INSERT INTO audit_process_tracking 
            (`action`, 
             `date`, 
             `user_id`, 
             `description`) 
VALUES      ( 'Add service', 
              CURRENT_TIMESTAMP, 
              1, 
              'Se agregó Producto: Producto 2' ); 

INSERT INTO audit_process_tracking 
            (`action`, 
             `date`, 
             `user_id`, 
             `description`) 
VALUES      ( 'Add role', 
              CURRENT_TIMESTAMP, 
              1, 
              'Se agregó rol: Administrador' ); 

INSERT INTO audit_process_tracking 
            (`action`, 
             `date`, 
             `user_id`, 
             `description`) 
VALUES      ( 'Add role', 
              CURRENT_TIMESTAMP, 
              1, 
              'Se agregó rol: Cliente' ); 

CREATE TABLE `user_detail` 
  ( 
     `id`              INT (11) NOT NULL auto_increment, 
     `dni`             VARCHAR (100) NOT NULL, 
     `address`         VARCHAR (100) NOT NULL, 
     `bachelor_degree` VARCHAR (200) NOT NULL, 
     `social_media`    VARCHAR (200) NOT NULL, 
     `parent_names`    VARCHAR (200) NOT NULL, 
     `user_id`         INT (11) NOT NULL, 
     PRIMARY KEY (`id`), 
     CONSTRAINT fk_user_detail_1 FOREIGN KEY (user_id) REFERENCES users (id) 
  ) 
engine = innodb; 

INSERT INTO user_detail 
            (`dni`, 
             `address`, 
             `bachelor_degree`, 
             `social_media`, 
             `parent_names`, 
             `user_id`) 
VALUES      ( '123591', 
              'Cr 16 # 145 - 30', 
              'Ingenieria de Sistemas', 
              '@gaboplums - @gabo_tweet', 
              'Alfonso Peña, Carmenza Rodriguez', 
              1 ); 

INSERT INTO user_detail 
            (`dni`, 
             `address`, 
             `bachelor_degree`, 
             `social_media`, 
             `parent_names`, 
             `user_id`) 
VALUES      ( '134982', 
              'Calle 134 # 15 - 34', 
              'Ingenieria de Sistemas', 
              '@perezoso - @perez_tweet', 
              'Daniel Perez, Camila Angel', 
              2 ); 