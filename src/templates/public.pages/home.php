<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('./src/templates/public.component/head.php') ?>
    <link rel="stylesheet" href="<?= $DATA['http_domain'] ?>public/css.public/slider.css">
    <link rel="stylesheet" href="<?= $DATA['http_domain'] ?>public/css.public/inicio.css">
    <style>
        :root {
            --url_bg_wave_bottom: url('<?= $DATA['http_domain'] ?>public/img/bg_wave_bottom.svg');
            --url_bg_wave_top: url('<?= $DATA['http_domain'] ?>public/img/bg_wave_top.svg');
        }
    </style>
</head>

<body>

    <header>
        <?php include('./src/templates/public.component/header.php') ?>
    </header>

    <main class="animate__animated animate__fadeIn">
        <slider>
            <?php include('./src/templates/public.component/slider.php') ?>
        </slider>
        <!--//? Servicios -->
        <section class="servicios">
            <div class="container">
                <?php foreach ($DATA['servicios'] as $item) { ?>
                    <div class="item">
                        <img src="<?= $DATA['http_domain'] ?>public/img.servicios/<?= $item['servicio_imagen'] ?>?last=<?= $item['servicio_last'] ?>" alt="Imagen servicio <?= $item['servicio_nombre'] ?>">
                        <span><?= $item['servicio_nombre'] ?></span>
                    </div>
                <?php  } ?>
            </div>
        </section>

        <!--//? Nuestra filosofia -->
        <section class="filosofia">
            <div class="container">
                <h2>Nuestra filosofía</h2>
                <div class="item">
                    <p><?= $DATA['info']['info_filosofia'] ?></p>
                    <dv class="img">
                        <img src="<?= $DATA['http_domain'] ?>public/img/filosofia.png" alt="Imagen de Folosofia">
                    </dv>
                </div>
                <div class="doctores">
                    <?php foreach ($DATA['doctores'] as $item) { ?>
                        <div class="item">
                            <img src="<?= $DATA['http_domain'] ?>public/img.users/<?= $item['user_foto'] ?>?last=<?= $item['user_last'] ?>" alt="Foto del Doctor <?= $item['user_nombre'] ?>">
                            <b>Dr. <?= $item['user_nombre'] ?></b>
                            <span><?= $item['user_especialidad'] ?></span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <!-- //? Consulta -->
        <section class="consultar">
            <div class="container">
                <h2>Deja que tu sonrisa hable por ti</h2>
                <div class="item">
                    <div class="img">
                        <img src="<?= $DATA['http_domain'] ?>public/img/persona_señalando.png" alt="Imagen de Consulta">
                    </div>
                    <di class="button">
                        <a href="<?= $DATA['http_domain'] ?>citas">
                            <span>Quiero una consulta</span>
                            <i class="fas fa-paper-plane"></i>
                        </a>
                    </di>
                </div>
            </div>
        </section>
    </main>

    <footer id="section-footer">
        <?php include('./src/templates/public.component/footer.php') ?>
    </footer>
</body>

<foot>
    <?php include('./src/templates/public.component/foot.php') ?>
    <script src="<?= $DATA['http_domain'] ?>public/js.public/slider.component.js"></script>
</foot>

</html>