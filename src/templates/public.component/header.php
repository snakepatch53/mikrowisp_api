<menu>
    <nav>
        <a href="<?= $DATA['http_domain'] ?>" class="logo">
            <img src="<?= $DATA['http_domain'] ?>public/img/logo3.png?last=<?= $DATA['info']['info_last'] ?>" alt="Logo Morona Net">
        </a>
        <ul class="supp">
            <li>
                <a href="<?= $DATA['http_domain'] ?>" class="link <?= strtolower($DATA['title']) == "home" ? "active" : "" ?>">
                    <span>Inicio</span>
                </a>
            </li>
            <li>
                <a href="<?= $DATA['http_domain'] ?>contactos" class="link <?= strtolower($DATA['title']) == "contactos" ? "active" : "" ?>">
                    <span>Contactos</span>
                </a>
            </li>
            <li>
                <a href="<?= $DATA['http_domain'] ?>nosotros" class="link <?= strtolower($DATA['title']) == "nosotros" ? "active" : "" ?>">
                    <span>Nosotros</span>
                </a>
            </li>
            <li class="movil">
                <a class="button link" href="<?= $DATA['http_domain'] ?>citas">
                    <span>Citas</span>
                    <i class="fas fa-calendar-alt"></i>
                </a>
            </li>
        </ul>
        <a class="button link" href="<?= $DATA['http_domain'] ?>citas">
            <span>Citas</span>
            <i class="fas fa-calendar-alt"></i>
        </a>
        <button class="burguer-menu" id="burguer-menu">
            <i class="fas fa-bars"></i>
        </button>
    </nav>
</menu>