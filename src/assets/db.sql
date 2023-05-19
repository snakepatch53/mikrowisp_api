DROP TABLE IF EXISTS info;

CREATE TABLE info (
    info_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    info_nombre VARCHAR(100),
    info_internal_token VARCHAR(100),
    info_mkw_api_url TEXT,
    info_mkw_api_token TEXT,
    info_last VARCHAR(50),
    info_created VARCHAR(50)
) ENGINE INNODB;

INSERT INTO
    info
VALUES
    (
        1,
        "Javier Bermeo API",
        "frB2CYI@%CJlkOs@bqoS@8y16^T",
        "http://167.71.189.123/api/v1/",
        "MzBnNDBqa2NCTE53ZXBjVTZUMFljdz09",
        "2023-01-01 00:00:00",
        "2023-01-01 00:00:00"
    );

DROP TABLE IF EXISTS user;

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_name VARCHAR(50),
    user_user VARCHAR(50),
    user_pass VARCHAR(200),
    user_photo VARCHAR(100) DEFAULT 'default.png',
    user_last VARCHAR(50),
    user_created VARCHAR(50)
) ENGINE INNODB;

INSERT INTO
    users
VALUES
    (
        1,
        'Administrador',
        'admin',
        'admin',
        'default.png',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        2,
        'Root',
        'rvelyljqg679',
        'tqR7$P@TKA7U',
        'default.png',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    );

DROP TABLE IF EXISTS clients;

CREATE TABLE clients (
    client_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    client_mkw_id VARCHAR(100),
    client_mkw_dni VARCHAR(100),
    client_name VARCHAR(100),
    client_last VARCHAR(50),
    client_created VARCHAR(50),
    UNIQUE (client_mkw_id),
    UNIQUE (client_mkw_dni)
) ENGINE INNODB;

DROP TABLE IF EXISTS client_files;

CREATE TABLE client_files (
    client_file_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    client_file_name VARCHAR(100),
    client_file_desc TEXT,
    client_file_stored VARCHAR(100),
    client_file_last VARCHAR(50),
    client_file_created VARCHAR(50),
    client_id INT,
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
) ENGINE INNODB;