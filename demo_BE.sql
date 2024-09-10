CREATE TABLE laboran (
    id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(255) UNIQUE NOT NULL,
    email varchar(255) UNIQUE NOT NULL,
    password varchar(255) NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
); 

CREATE TABLE asisten (
    id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nim varchar(255) UNIQUE NOT NULL,
    name varchar(255) NOT NULL,
    code varchar(255) UNIQUE NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
);

CREATE TABLE shift (
    id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) NOT NULL,
    start_time time NULL DEFAULT '00:00:00',
    end_time time NULL DEFAULT '00:00:00',
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
);  

CREATE TABLE shift_asisten  (
    id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
    asisten_id bigint NOT NULL,
    shift_id bigint NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
);

ALTER TABLE shift_asisten
ADD CONSTRAINT asisten_id FOREIGN KEY (asisten_id) REFERENCES asisten(id) ON DELETE CASCADE,
ADD CONSTRAINT shift_id FOREIGN KEY (shift_id) REFERENCES shift(id) ON DELETE CASCADE;