<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('./src/templates/panel.component/head.php') ?>
    <link rel="stylesheet" href="<?= $DATA['http_domain'] ?>public/css.panel/info.css">
</head>

<body>
    <?php include('./src/templates/panel.component/header.php') ?>
    <?php include('./src/templates/panel.component/sidebar.php') ?>
    <main>
        <div class="pt-4 px-md-5 px-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $DATA['http_domain'] ?>/panel">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Informacion</li>
                </ol>
            </nav>
            <div class="card shadow">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <b>Informacion</b>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Form ini -->
                    <form class="needs-validation p-4" id="element-form" onsubmit="return false" editMode="false" novalidate>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="validationServer01" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="validationServer01" name="info_nombre" required>
                                <div class="invalid-feedback">
                                    Escribe el nombre!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer04" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" id="validationServer04" name="info_ciudad" required>
                                <div class="invalid-feedback">
                                    Escribe la ciudad!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer05" class="form-label">Direccion</label>
                                <input type="text" class="form-control" id="validationServer05" name="info_direccion" required>
                                <div class="invalid-feedback">
                                    Escribe la direccion!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer02" class="form-label">Small Logo Dark</label>
                                <input type="file" class="form-control" id="validationServer02" name="info_logo1">
                                <div class="preview_img">
                                    <img src="<?= $DATA['http_domain'] ?>public/img/logo1.png?last=<?= $DATA['info']['info_last'] ?>" alt="Preview" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer03" class="form-label">Small Logo Light</label>
                                <input type="file" class="form-control" id="validationServer03" name="info_logo2">
                                <div class="preview_img light">
                                    <img src="<?= $DATA['http_domain'] ?>public/img/logo2.png?last=<?= $DATA['info']['info_last'] ?>" alt="Preview" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer14" class="form-label">Big Logo Dark</label>
                                <input type="file" class="form-control" id="validationServer14" name="info_logo3">
                                <div class="preview_img">
                                    <img src="<?= $DATA['http_domain'] ?>public/img/logo3.png?last=<?= $DATA['info']['info_last'] ?>" alt="Preview" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer06" class="form-label">Telefono</label>
                                <input type="text" class="form-control" id="validationServer06" name="info_telefono" required>
                                <div class="invalid-feedback">
                                    Escribe el telefono!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer07" class="form-label">Celular</label>
                                <input type="text" class="form-control" id="validationServer07" name="info_celular" required>
                                <div class="invalid-feedback">
                                    Escribe el celular!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer08" class="form-label">Email</label>
                                <input type="text" class="form-control" id="validationServer08" name="info_email" required>
                                <div class="invalid-feedback">
                                    Escribe el email!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer09" class="form-label">Mapa</label>
                                <input type="text" class="form-control" id="validationServer09" name="info_mapa" required>
                                <div class="invalid-feedback">
                                    Inserta un mapa!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer10" class="form-label">Filosofia</label>
                                <textarea class="form-control" id="validationServer10" name="info_filosofia" required></textarea>
                                <div class="invalid-feedback">
                                    Escribe la filosofia del negocio!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer11" class="form-label">Resumen</label>
                                <textarea class="form-control" id="validationServer11" name="info_resumen" required></textarea>
                                <div class="invalid-feedback">
                                    Escribe el resumen!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer12" class="form-label">Mision</label>
                                <textarea class="form-control" id="validationServer12" name="info_mision" required></textarea>
                                <div class="invalid-feedback">
                                    Escribe el mision!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer13" class="form-label">Vision</label>
                                <textarea class="form-control" id="validationServer13" name="info_vision" required></textarea>
                                <div class="invalid-feedback">
                                    Escribe el vision!
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-5" id="btn-submit">Guardar</button>
                        </div>
                    </form>
                    <!-- Form end -->
                </div>
            </div>
        </div>
    </main>
</body>
<foot>
    <?php include('./src/templates/panel.component/foot.php') ?>
    <script src="<?= $DATA['http_domain'] ?>public/js.panel/info.js"></script>
</foot>

</html>