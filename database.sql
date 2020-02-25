DROP DATABASE `tecnicas_ataque`;
CREATE DATABASE `tecnicas_ataque`;

USE `tecnicas_ataque`;

CREATE TABLE `users`
( 
     `id`       INT
(11) NOT NULL auto_increment, 
     `name`     VARCHAR
(100) NOT NULL, 
     `email`    VARCHAR
(100) NOT NULL, 
     `username` VARCHAR
(100) NOT NULL, 
     `pass`     VARCHAR
(100) NOT NULL,
     `role`     VARCHAR
(100) NOT NULL,
     `active`   BIT,
     PRIMARY KEY
(`id`) 
  ) 
engine = innodb;

INSERT INTO users
    (`name`, `email
`, `username`, `pass`, `role`, `active`) VALUES
('Gabriel Pena', 'gabriel.p16@gmail.com', 'gabo', md5
('123'), 'administrador', 1);

INSERT INTO users
    (`name`, `email
`, `username`, `pass`, `role`, `active`) VALUES
('Daniel Perez', 'daniel@gmail.com', 'dani', md5
('123'), 'cliente', 1);


CREATE TABLE `services`
( 
     `id`       INT
(11) NOT NULL auto_increment, 
     `name`     VARCHAR
(100) NOT NULL, 
     `qty`      INT
(5) NOT NULL, 
     `price`    INT
(10) NOT NULL, 
     `users_id` INT
(11) NOT NULL, 
     PRIMARY KEY
(`id`), 
     CONSTRAINT fk_services_1 FOREIGN KEY
(users_id) REFERENCES users
(id) 
  ) 
engine = innodb;

INSERT INTO services
    (`name`, `qty
`, `price`, `users_id`) VALUES
('Producto 1', 100, 2000, 1);

INSERT INTO services
    (`name`, `qty
`, `price`, `users_id`) VALUES
('Producto 2', 150, 3000, 1);

CREATE TABLE `roles`
( 
     `id`   INT
(11) NOT NULL auto_increment, 
     `name` VARCHAR
(100) NOT NULL, 
     PRIMARY KEY
(`id`) 
  ) 
engine = innodb;

INSERT INTO roles
    (`name`)
VALUES
    ('administrador');

INSERT INTO roles
    (`name`)
VALUES
    ('cliente');

CREATE TABLE `users_roles`
( 
     `role_id` INT
(11) NOT NULL, 
     `users_id` INT
(11) NOT NULL, 
     CONSTRAINT fk_users_roles_1 FOREIGN KEY
(role_id) REFERENCES roles
(id), 
     CONSTRAINT fk_users_roles_2 FOREIGN KEY
(users_id) REFERENCES users
(id) 
  ) 
engine = innodb;

INSERT INTO users_roles
    (`role_id`, `users_id
`) VALUES
(1,1);

INSERT INTO users_roles
    (`role_id`, `users_id
`) VALUES
(2,2);


CREATE TABLE `audit_process_tracking`
( 
    `id` INT
(11) NOT NULL auto_increment,  
    `action` VARCHAR
(100) NOT NULL, 
    `date` TIMESTAMP NOT NULL, 
    `user_id` INT
(11) NOT NULL,
    `description` VARCHAR
(200) NOT NULL,
     PRIMARY KEY
(`id`), 
     CONSTRAINT fk_audit_process_tracking_1 FOREIGN KEY
(user_id) REFERENCES users
(id) 
  ) 
engine = innodb;

INSERT INTO audit_process_tracking
    (`action`, `date
`, `user_id`, `description`) VALUES
('Add service', CURRENT_TIMESTAMP, 1, 'Se agregó servicio: Producto 1' );

INSERT INTO audit_process_tracking
    (`action`, `date
`, `user_id`, `description`) VALUES
('Add service', CURRENT_TIMESTAMP, 1, 'Se agregó servicio: Producto 2' );

INSERT INTO audit_process_tracking
    (`action`, `date
`, `user_id`, `description`) VALUES
('Add role', CURRENT_TIMESTAMP, 1, 'Se agregó rol: Administrador');

INSERT INTO audit_process_tracking
    (`action`, `date
`, `user_id`, `description`) VALUES
('Add role', CURRENT_TIMESTAMP, 1, 'Se agregó rol: Cliente');
