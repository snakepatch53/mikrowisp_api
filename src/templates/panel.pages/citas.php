<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('./src/templates/panel.component/head.php') ?>
</head>

<body>
    <?php include('./src/templates/panel.component/header.php') ?>
    <?php include('./src/templates/panel.component/sidebar.php') ?>
    <main>
        <!-- CONTENT PAGE | INI -->
        <div class=" pt-4 px-md-5 px-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $DATA['http_domain'] ?>/panel">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Citas</li>
                </ol>
            </nav>
            <div class="card shadow">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <b>Citas</b>
                        <button class="btn btn-outline-success" onclick="handleFunction.new()">
                            <i class="fa-solid fa-plus"></i>
                            <span>Crear nuevo</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover border">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th class="d-none d-md-table-cell" scope="col">#</th>
                                <th class="text-center text-md-left" scope="col">Cliente</th>
                                <th class="text-center text-md-left" scope="col">Fecha</th>
                                <th class="d-none d-md-table-cell text-center text-md-left" scope="col">Doctor</th>
                                <th class="d-none d-md-table-cell text-center text-md-left" scope="col">Servicio</th>
                                <th class="text-center" scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="element-table"></tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- CONTENT PAGE | END -->

        <!-- MODAL | INI -->
        <!-- gift | ini -->

        <!-- gift | end -->

        <!-- form | ini -->
        <div class="modal fade" id="element-modalform" tabindex="-1" aria-labelledby="element-modalformLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content needs-validation" id="element-form" onsubmit="return false" novalidate>
                    <input type="hidden" name="cita_id" value="0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="element-modalformLabel">Formulario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- form | ini -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="validationServer01" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="validationServer01" placeholder="Fecha.." name="cita_fecha" required>
                                <div class="invalid-feedback">
                                    Selecciona la fecha!
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="validationServer02" class="form-label">Hora</label>
                                <select class="form-control form-select" name="hora_id" id="validationServer02" required>
                                    <option value="">Selecciona una hora</option>
                                    <?php foreach ($DATA['horas'] as $item) { ?>
                                        <option value="<?= $item['hora_id'] ?>"><?= $item['hora_hora'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona la hora!
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="validationServer03" class="form-label">Cliente</label>
                                <select class="form-control form-select" name="cliente_id" id="validationServer03" required>
                                    <option value="">Seleccione un Cliente</option>
                                    <?php foreach ($DATA['clientes'] as $item) { ?>
                                        <option value="<?= $item['cliente_id'] ?>"><?= $item['cliente_nombre'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona el cliente!
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="validationServer04" class="form-label">Doctor</label>
                                <!-- RESTRICCION PARA DOCTORES | INICIO -->
                                <?php if ($_SESSION['user_tipo'] == "user") { ?>
                                    <select class="form-control form-select" name="user_id" id="validationServer04" required>
                                        <option value="">Seleccione un Doctor</option>
                                        <?php foreach ($DATA['doctores'] as $item) { ?>
                                            <option value="<?= $item['user_id'] ?>"><?= $item['user_nombre'] ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <input type="text" name="user_id" value="<?= $_SESSION['user_id'] ?>" hidden>
                                    <input type="text" class="form-control" value="<?= $_SESSION['user_nombre'] ?>" disabled>
                                <?php } ?>
                                <!-- RESTRICCION PARA DOCTORES | FIN -->
                                <div class="invalid-feedback">
                                    Selecciona el doctor!
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="validationServer05" class="form-label">Servicio</label>
                                <select class="form-control form-select" name="servicio_id" id="validationServer05" required>
                                    <option value="">Seleccione un servicio</option>
                                    <?php foreach ($DATA['servicios'] as $item) { ?>
                                        <option value="<?= $item['servicio_id'] ?>"><?= $item['servicio_nombre'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona el servicio!
                                </div>
                            </div>



                        </div>
                        <!-- form | end -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- form | end -->

        <!-- confirm | ini -->
        <div class="modal fade" id="element-modalconfirm" tabindex="-1" aria-labelledby="element-modalconfirmLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="element-modalconfirmLabel">Eliminar registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estas seguro de eliminar este registro?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="crudFunction.delete()">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- confirm | end -->
        <!-- MODAL | END -->
    </main>
</body>
<foot>
    <?php include('./src/templates/panel.component/foot.php') ?>
    <script src="<?= $DATA['http_domain'] ?>public/js.panel/citas.js"></script>
</foot>

</html>