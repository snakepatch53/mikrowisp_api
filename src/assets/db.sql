DROP TABLE IF EXISTS info;

CREATE TABLE info (
    info_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    info_nombre VARCHAR(100),
    info_filosofia TEXT,
    info_resumen TEXT,
    info_mision TEXT,
    info_vision TEXT,
    info_mapa TEXT,
    info_direccion VARCHAR(100),
    info_ciudad VARCHAR(50),
    info_telefono VARCHAR(11),
    info_celular VARCHAR(11),
    info_email VARCHAR(100),
    info_last VARCHAR(50)
) ENGINE INNODB;

INSERT INTO
    info
VALUES
    (
        1,
        "Dr. Ayora's",
        'En nuestra clínica dental, nos enfocamos en ofrecer una atención personalizada y de alta calidad, utilizando las últimas tecnologías y técnicas en odontología. Nuestro objetivo es ayudar a nuestros pacientes a lograr una sonrisa saludable y radiante a través de objetivos personalizados, educación y atención centrada en el paciente.',
        '
            La Clínica Odontología del Dr. Claudio ayora abrió sus puertas por primera vez hace más de 10 años en Sucua. Desde entonces, hemos estado comprometidos con brindar atención dental de alta calidad a nuestros pacientes.
            <br>
            <br>
            La idea de abrir nuestra propia clínica dental surgió cuando el Dr. Claudio ayora, nuestro fundador y director, se dio cuenta de que muchos pacientes no estaban recibiendo el nivel de atención personalizada que merecían. Él quería crear un lugar donde los pacientes se sintieran cómodos y confiados en que estaban recibiendo el mejor cuidado posible.
            <br>
            <br>
            A lo largo de los años, hemos expandido nuestros servicios para incluir una amplia gama de tratamientos dentales, desde limpiezas regulares y blanqueamiento dental hasta implantes dentales y ortodoncia. También hemos incorporado tecnología de vanguardia para garantizar que nuestros pacientes reciban el tratamiento más avanzado y efectivo.
            <br>
            <br>
            En la Clínica Odontología del Dr. Claudio ayora, creemos que cada paciente es único y merece una atención personalizada. Nos tomamos el tiempo para conocer a cada paciente y entender sus necesidades y preocupaciones. Trabajamos en colaboración con cada paciente para crear un plan de tratamiento personalizado que aborde sus necesidades dentales y de salud en general.
            <br>
            <br>
            Nuestro objetivo es brindar atención dental de alta calidad en un ambiente cálido y acogedor. Nos enorgullece contar con un equipo de odontólogos altamente capacitados y experimentados que están comprometidos con el éxito y la satisfacción de nuestros pacientes.
            <br>
            <br>
            Estamos emocionados de seguir creciendo y de continuar brindando atención dental excepcional a nuestros pacientes. Si está buscando un lugar para recibir atención dental de alta calidad y personalizada, ¡no dude en programar una cita en la Clínica Odontología del Dr. Claudio ayora!
        ',
        'En la Clínica Odontología del Dr. Claudio ayora, nuestra misión es brindar atención dental de alta calidad y personalizada a cada paciente que visite nuestra clínica. Estamos comprometidos con la excelencia en la atención dental, utilizando tecnología avanzada y un equipo de odontólogos altamente capacitados para garantizar la satisfacción del paciente y su bienestar dental a largo plazo.',
        'Nuestra visión es convertirnos en la clínica dental líder en nuestra comunidad, brindando atención dental excepcional y personalizada a nuestros pacientes. Queremos ser reconocidos como el lugar donde los pacientes confían en recibir una atención de calidad, y donde nuestro equipo de odontólogos se sienten valorados y satisfechos con su trabajo. Nuestra visión es ser un lugar donde la atención dental sea una experiencia positiva y donde nuestros pacientes se sientan seguros y cómodos con el tratamiento que reciben.',
        '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31889.19572367189!2d-78.18737995101472!3d-2.4573081591680483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91cdf6ec4ec0ed79%3A0x32424d842480941f!2zU3Vjw7ph!5e0!3m2!1ses!2sec!4v1679360301751!5m2!1ses!2sec" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        'Domingo comin y kiruba',
        'Sucua',
        '0986719637',
        '0986137316',
        'infor@dental.com',
        '2023-01-01 00:00:00'
    );

DROP TABLE IF EXISTS social;

CREATE TABLE social (
    social_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    social_nombre VARCHAR(50),
    social_url VARCHAR(100),
    social_icon VARCHAR(50),
    social_color VARCHAR(50),
    social_last VARCHAR(50),
    social_created VARCHAR(50)
) ENGINE INNODB;

INSERT INTO
    social
VALUES
    (
        1,
        'Whatsapp',
        'https://api.whatsapp.com/send?phone=593986719637&text=Hola%20quiero%20saber%20m%C3%A1s%20sobre%20sus%20servicios',
        '<i class="fab fa-whatsapp"></i>',
        '#25D366',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        2,
        'Facebook',
        'https://www.facebook.com/',
        'fab fa-facebook-f',
        '3b5998',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        3,
        'Instagram',
        'https://www.instagram.com/',
        'fab fa-instagram',
        '#833ab4',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    );

DROP TABLE IF EXISTS slider;

CREATE TABLE slider (
    slider_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    slider_titulo VARCHAR(100),
    slider_imagen VARCHAR(50),
    slider_last VARCHAR(50),
    slider_created VARCHAR(50)
) ENGINE INNODB;

INSERT INTO
    slider
VALUES
    (
        1,
        'Bienvenido a la Clínica Odontología del Dr. Claudio ayora',
        '1.png',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        2,
        'El mejor equipo de odontólogos en Sucua',
        '2.png',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        3,
        'Nuestro trabajo es garantizar su bienestar dental',
        '3.png',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    );

DROP TABLE IF EXISTS servicios;

CREATE TABLE servicios (
    servicio_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    servicio_nombre VARCHAR(50),
    servicio_imagen VARCHAR(50),
    servicio_descripcion TEXT,
    servicio_last VARCHAR(50),
    servicio_created VARCHAR(50)
) ENGINE INNODB;

INSERT INTO
    servicios
VALUES
    (
        1,
        'Ortodoncia',
        '1.png',
        'La ortodoncia es la especialidad de la odontología que se encarga de corregir la posición de los dientes y de los huesos maxilares. La ortodoncia puede ser necesaria para corregir problemas de mordida, de alineación de los dientes o de la posición de los dientes.',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        2,
        'Profilaxis',
        '2.png',
        'La profilaxis es una limpieza dental profunda que se realiza en la clínica dental. La profilaxis elimina la placa dental y el sarro de los dientes y de las encías. La profilaxis también elimina las manchas de los dientes.',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        3,
        'Carillas',
        '3.png',
        'Las carillas son láminas de porcelana o de composite que se adhieren a la superficie de los dientes. Las carillas se utilizan para corregir problemas estéticos como los dientes rotos, los dientes desalineados, los dientes con manchas, los dientes con espacios entre ellos, los dientes con forma irregular, etc.',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        4,
        'Endodoncia',
        '4.png',
        'La endodoncia es una rama de la odontología que se encarga de tratar las infecciones de los dientes. La endodoncia se realiza cuando el nervio de un diente está infectado. La endodoncia se realiza para salvar el diente y evitar que se pierda.',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    );

DROP TABLE IF EXISTS horas;

CREATE TABLE horas (
    hora_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    hora_hora VARCHAR(50),
    hora_last VARCHAR(50),
    hora_created VARCHAR(50)
) ENGINE INNODB;

INSERT INTO
    horas
VALUES
    (
        1,
        '08:00',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        2,
        '09:00',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        3,
        '10:00',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        4,
        '11:00',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        5,
        '12:00',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        6,
        '14:00',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        7,
        '15:00',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        8,
        '16:00',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    );

DROP TABLE IF EXISTS mensajes;

CREATE TABLE mensajes (
    mensaje_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    mensaje_nombre VARCHAR(100),
    mensaje_celular VARCHAR(50),
    mensaje_email VARCHAR(50),
    mensaje_mensaje TEXT,
    mensaje_last VARCHAR(50),
    mensaje_created VARCHAR(50)
) ENGINE INNODB;

DROP TABLE IF EXISTS user;

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_nombre VARCHAR(50),
    user_especialidad VARCHAR(50),
    user_user VARCHAR(50),
    user_pass VARCHAR(200),
    user_foto VARCHAR(100) DEFAULT 'default.png',
    user_tipo VARCHAR(50) DEFAULT 'user',
    user_last VARCHAR(50),
    user_created VARCHAR(50)
) ENGINE INNODB;

INSERT INTO
    users
VALUES
    (
        1,
        'Administrador',
        null,
        'admin',
        'admin',
        'default.png',
        'user',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        2,
        'Root',
        null,
        'doctorayora',
        'Pr&3W2L73#NGY5Ty',
        'default.png',
        'user',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        3,
        'Claudio Ayora',
        'Odontologia',
        'claudio',
        'claudio123',
        '1.png',
        'doctor',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    ),
    (
        4,
        'David Ayora',
        'Odontologia',
        'david',
        'david123',
        '2.png',
        'doctor',
        '2023-01-01 00:00:00',
        '2023-01-01 00:00:00'
    );

DROP TABLE IF EXISTS clientes;

CREATE TABLE clientes (
    cliente_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    cliente_nombre VARCHAR(100),
    cliente_cedula VARCHAR(50),
    cliente_celular VARCHAR(50),
    cliente_email VARCHAR(50),
    cliente_direccion VARCHAR(50),
    cliente_last VARCHAR(50),
    cliente_created VARCHAR(50)
) ENGINE INNODB;

DROP TABLE IF EXISTS citas;

CREATE TABLE citas (
    cita_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    cita_fecha VARCHAR(50),
    cita_last VARCHAR(50),
    cita_created VARCHAR(50),
    cliente_id INT,
    user_id INT,
    hora_id INT,
    servicio_id INT,
    FOREIGN KEY (cliente_id) REFERENCES clientes (cliente_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE,
    FOREIGN KEY (hora_id) REFERENCES horas (hora_id) ON DELETE CASCADE,
    FOREIGN KEY (servicio_id) REFERENCES servicios (servicio_id) ON DELETE CASCADE
) ENGINE INNODB;