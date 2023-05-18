<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('./src/templates/public.component/head.php') ?>
    <style>
        :root {
            --url_bg_citaform: url('<?= $DATA['http_domain'] ?>public/img/citaform_background.png');
        }
    </style>
    <link rel="stylesheet" href="<?= $DATA['http_domain'] ?>public/css.public/citas.css">
    <link rel="stylesheet" href="<?= $DATA['http_domain'] ?>public/library.general/flatpickr.min.css">
</head>

<body>

    <header>
        <?php include('./src/templates/public.component/header.php') ?>
    </header>

    <main class="animate__animated animate__fadeIn">
        <section class="form">
            <div class="container">
                <div class="congratulations" id="congratulations">
                    <canvas id="canvas-confetti"></canvas>
                    <h2>¡Felicidades!</h2>
                    <p>Has agendado una cita con nosotros.</p>
                    <p>Te esperamos el <span id="cita-date"></span> a las <span id="cita-hour"></span> con el <span id="cita-doctor"></span></p>
                    <p>Recuerda que puedes cancelar tu cita en cualquier momento.</p>
                    <a id="print-a" href="<?= $DATA['http_domain'] ?>/" target="_blank">
                        <span>Imprimir ticket</span>
                        <i class="fas fa-print"></i>
                    </a>
                </div>
                <form id="citaform-cliente"> <!-- class="show" -->
                    <input type="hidden" value="0" name="cliente_id">
                    <div class="row">
                        <label for="cedula">Cedula: </label>
                        <div class="input" id="search-container">
                            <input type="text" name="cliente_cedula">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                    </div>
                    <div class="autocomplete">
                        <div class="col">
                            <div class="row">
                                <label for="nombre">Nombre: </label>
                                <input type="text" name="cliente_nombre">
                            </div>
                            <div class="row">
                                <label for="celular">Celular: </label>
                                <input type="text" name="cliente_celular">
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <label for="email">Email: </label>
                                <input type="text" name="cliente_email">
                            </div>
                            <div class="row">
                                <label for="direccion">Direccion: </label>
                                <input type="text" name="cliente_direccion">
                            </div>
                        </div>
                    </div>
                </form>
                <form id="citaform-cita">
                    <div class="col">
                        <!-- <img src="<?= $DATA['http_domain'] ?>public/img/calendario.png" alt="Imagen Calendario"> -->
                        <div class="calendar disabled" id="calendar-container">
                            <div class="flatpickr"></div>
                        </div>
                    </div>
                    <div class="col">
                        <label for="doctor">Eligir un especialista: </label>
                        <select name="user_id">
                            <option value="">Seleccione una opcion</option>
                            <?php foreach ($DATA['doctores'] as $item) { ?>
                                <option value="<?= $item['user_id'] ?>">Dr. <?= $item['user_nombre'] ?></option>
                            <?php } ?>
                        </select>
                        <label for="hora">Horarios disponibles: </label>
                        <select name="hora_id">
                            <option value="">Seleccione una opcion</option>
                            <!-- <?php foreach ($DATA['horas'] as $item) { ?>
                                <option value="<?= $item['hora_id'] ?>"><?= $item['hora_hora'] ?></option>
                            <?php } ?> -->
                        </select>
                        <label for="especialidad">Elegir una especialidad: </label>
                        <select name="servicio_id">
                            <option value="">Seleccione una opcion</option>
                            <?php foreach ($DATA['servicios'] as $item) { ?>
                                <option value="<?= $item['servicio_id'] ?>"><?= $item['servicio_nombre'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </form>
                <button id="btn-send">
                    <span>Agendar</span>
                    <i class="fas fa-calendar-alt"></i>
                </button>
            </div>
        </section>

        <section class="servicios">
            <div class="container">
                <ul>
                    <?php foreach ($DATA['servicios'] as $item) { ?>
                        <li>
                            <img src="<?= $DATA['http_domain'] ?>public/img.servicios/<?= $item['servicio_imagen'] ?>?last=<?= $item['servicio_last'] ?>" alt="Imagen de Servicio <?= $item['servicio_nombre'] ?>">
                            <h3><?= $item['servicio_nombre'] ?></h3>
                            <p><?= $item['servicio_descripcion'] ?></p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </section>
    </main>

    <footer id="section-footer">
        <?php include('./src/templates/public.component/footer.php') ?>
    </footer>
</body>

<foot>
    <?php include('./src/templates/public.component/foot.php') ?>
    <script src="<?= $DATA['http_domain'] ?>public/library.general/confetti.min.js"></script>
    <script src="<?= $DATA['http_domain'] ?>public/library.general/flatpickr.js"></script>
    <script src="<?= $DATA['http_domain'] ?>public/js.general/validacion.js"></script>
    <script src="<?= $DATA['http_domain'] ?>public/js.public/citas.js"></script>
</foot>

</html>