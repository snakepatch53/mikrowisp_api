<section>
    <div class="row">
        <a class="logo" href="<?= $DATA['http_domain'] ?>">
            <img src="<?= $DATA['http_domain'] ?>public/img/logo2.png?last=<?= $DATA['info']['info_last'] ?>" alt="logo">
        </a>
        <div class="info">
            <h1>Consultorio dental <?= $DATA['info']['info_nombre'] ?></h1>
            <p><?= $DATA['info']['info_direccion'] ?> - <?= $DATA['info']['info_ciudad'] ?></p>
            <p><?= $DATA['info']['info_celular'] ?> - <?= $DATA['info']['info_telefono'] ?></p>
            <p><?= $DATA['info']['info_email'] ?></p>
        </div>
        <div class="social">
            <h2>Nuestras Redes</h2>
            <div class="social-icons">
                <?php
                foreach ($DATA['social'] as $item) { ?>
                    <a target="_blank" href="<?= $item['social_url'] ?>" style="color:<?= $item['social_color'] ?>; border: solid 1px <?= $item['social_color'] ?>">
                        <?= $item['social_icon'] ?>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<section class="row copy">
    <p class="copy"><?= $DATA['info']['info_nombre'] ?> © <?= date('Y') ?> Todos los derechos reservados.</p>
</section>