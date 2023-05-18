<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('./src/templates/public.component/head.php') ?>
    <link rel="stylesheet" href="<?= $DATA['http_domain'] ?>public/css.public/nosotros.css">
</head>

<body>

    <header>
        <?php include('./src/templates/public.component/header.php') ?>
    </header>

    <main class="animate__animated animate__fadeIn">
        <section class="historia">
            <div class="container">
                <h2>Sobre Nosotros</h2>
                <p><?= $DATA['info']['info_resumen'] ?></p>
            </div>
        </section>
        <section class="mision">
            <div class="container">
                <h3>Misión</h3>
                <p><?= $DATA['info']['info_mision'] ?></p>
            </div>
        </section>
        <section class="vision">
            <div class="container">
                <h3>Visión</h3>
                <p><?= $DATA['info']['info_vision'] ?></p>
            </div>
        </section>
        <br><br><br><br><br>
    </main>

    <footer id="section-footer">
        <?php include('./src/templates/public.component/footer.php') ?>
    </footer>
</body>

<foot>
    <?php include('./src/templates/public.component/foot.php') ?>
</foot>

</html>