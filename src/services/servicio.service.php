<?php
class ServicioService
{

    public static function select($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $servicioDao = new ServicioDao($adapter);
        $servicios = $servicioDao->select();
        $result = [];
        $result['status'] = 'success';
        $result['message'] = 'Servicios obtenidos correctamente';
        $result['response'] = true;
        $result['data'] = $servicios;
        echo json_encode($result);
    }

    public static function insert($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para ingresar el servicio',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['servicio_nombre'],
            $_FILES['servicio_imagen'],
            $_POST['servicio_descripcion']
        )) {
            $adapter = $DATA['mysqlAdapter'];
            $servicioDao = new ServicioDao($adapter);
            $servicio_nombre = $_POST['servicio_nombre'];
            $servicio_descripcion = $_POST['servicio_descripcion'];
            $servicio_imagen = uploadFIle($_FILES['servicio_imagen'], './public/img.servicios/');
            $servicio_id = $servicioDao->insert(
                $servicio_nombre,
                $servicio_imagen,
                $servicio_descripcion
            );
            $result['status'] = 'success';
            $result['message'] = 'Servicio insertado correctamente';
            $result['response'] = true;
            $result['data'] = $servicio_id;
        }
        echo json_encode($result);
    }

    public static function update($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para actualizar el servicio',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['servicio_id'],
            $_POST['servicio_nombre'],
            $_POST['servicio_descripcion']
        )) {
            $adapter = $DATA['mysqlAdapter'];
            $servicioDao = new ServicioDao($adapter);
            $servicio_id = $_POST['servicio_id'];
            $current_servicio = $servicioDao->selectById($servicio_id);
            if (!$current_servicio) {
                $result['message'] = 'El servicio no existe';
                echo json_encode($result);
                exit();
            }
            $servicio_nombre = $_POST['servicio_nombre'];
            $servicio_descripcion = $_POST['servicio_descripcion'];
            $servicio_imagen = $current_servicio['servicio_imagen'];

            if (isset($_FILES['servicio_imagen'])) {
                if ($_FILES['servicio_imagen']['tmp_name'] != "" or $_FILES['servicio_imagen']['tmp_name'] != null) {
                    if (
                        $servicio_imagen != '1.png' &&
                        $servicio_imagen != '2.png' &&
                        $servicio_imagen != '3.png' &&
                        $servicio_imagen != '4.png' &&
                        $servicio_imagen != ''
                    ) {
                        deleteFile('./public/img.servicios/' . $servicio_imagen);
                    }
                    $servicio_imagen = uploadFIle($_FILES['servicio_imagen'], './public/img.servicios/');
                }
            }

            $servicio = $servicioDao->update(
                $servicio_id,
                $servicio_nombre,
                $servicio_imagen,
                $servicio_descripcion
            );
            if (!$servicio) {
                $result['message'] = 'No se pudo actualizar el servicio';
                echo json_encode($result);
                exit();
            }
            $result['status'] = 'success';
            $result['message'] = 'Servicio actualizado correctamente';
            $result['response'] = true;
            $result['data'] = $servicio;
        }
        echo json_encode($result);
    }

    public static function delete($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Usuario o contraseña incorrectos',
            'response' => false,
            'data' => null
        ];
        if (isset($_POST['servicio_id'])) {
            $adapter = $DATA['mysqlAdapter'];
            $servicioDao = new ServicioDao($adapter);
            $servicio_id = $_POST['servicio_id'];
            $servicio = $servicioDao->selectById($servicio_id);
            if (!$servicio) {
                $result['message'] = 'El servicio no existe';
                echo json_encode($result);
                exit();
            }
            if (
                $servicio['servicio_imagen'] != '1.png' &&
                $servicio['servicio_imagen'] != '2.png' &&
                $servicio['servicio_imagen'] != '3.png' &&
                $servicio['servicio_imagen'] != '4.png' &&
                $servicio['servicio_imagen'] != ''
            ) {
                deleteFile('./public/img.servicios/' . $servicio['servicio_imagen']);
            }
            $servicio = $servicioDao->deleteById($servicio_id);
            $result['status'] = 'success';
            $result['message'] = 'Servicio eliminado correctamente';
            $result['response'] = true;
            $result['data'] = $servicio;
        }
        echo json_encode($result);
    }
}
