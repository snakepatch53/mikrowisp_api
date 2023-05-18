DROP TABLE IF EXISTS info;

CREATE TABLE info (
    info_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    info_nombre VARCHAR(100),
    info_mkw_api_version VARCHAR(10) DEFAULT '6',
    info_mkw_api_url TEXT,
    info_mkw_api_user TEXT,
    info_mkw_api_pass TEXT,
    info_last VARCHAR(50),
    info_created VARCHAR(50)
) ENGINE INNODB;

INSERT INTO
    info
VALUES
    (
        1,
        "Javier Bermeo API",
        "6",
        "http://157.100.9.33:8015/admin/api.php",
        "tecnico",
        "tecnico",
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