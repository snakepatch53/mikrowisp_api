<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('./src/templates/public.component/head.php') ?>
    <style>
        :root {
            --url_bg_contactform: url('<?= $DATA['http_domain'] ?>public/img/contactform_background.png');
        }
    </style>
    <link rel="stylesheet" href="<?= $DATA['http_domain'] ?>public/css.public/contactos.css">
</head>

<body>

    <header>
        <?php include('./src/templates/public.component/header.php') ?>
    </header>

    <main class="animate__animated animate__fadeIn">
        <section class="contact-form">
            <div class="container">
                <form id="form">
                    <div class="congratulations" id="congratulations">
                        <canvas id="confetti"></canvas>
                        <i class="fas fa-check-circle"></i>
                        <h2>¡Gracias por contactarnos!</h2>
                        <p>En breve nos pondremos en contacto contigo.</p>
                        <a href="<?= $DATA['http_domain'] ?>">
                            <i class="fas fa-home"></i>
                            <span>Ir a inicio</span>
                        </a>
                    </div>
                    <div class="row">
                        <di class="item">
                            <label for="name"><b>*</b>Nombres y apellidos</label>
                            <input type="text" name="mensaje_nombre">
                            <span class="error"></span>
                        </di>
                    </div>
                    <div class="row">
                        <div class="item">
                            <label for="phone"><b>*</b>Celular</label>
                            <input type="phone" name="mensaje_celular">
                            <span class="error"></span>
                        </div>
                        <div class="item">
                            <label for="email"><b>*</b>Correo electronico</label>
                            <input type="email" name="mensaje_email">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="item">
                            <label for="message"><b>*</b>Mensaje</label>
                            <textarea name="mensaje_mensaje"></textarea>
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="item">
                            <button type="submit">
                                <span>Enviar</span>
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                </form>
            </div>
        </section>
        <section class="contact-map"><?= $DATA['info']['info_mapa']; ?></section>
    </main>

    <footer id="section-footer">
        <?php include('./src/templates/public.component/footer.php') ?>
    </footer>
</body>

<foot>
    <?php include('./src/templates/public.component/foot.php') ?>
    <script src="<?= $DATA['http_domain'] ?>public/library.general/confetti.min.js"></script>
    <script src="<?= $DATA['http_domain'] ?>public/js.public/contactos.js"></script>
</foot>

</html>