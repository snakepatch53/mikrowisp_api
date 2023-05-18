<?php
class CitaService
{

    public static function select($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $citaDao = new CitaDao($adapter);
        $citas = $citaDao->select();
        echo json_encode([
            'status' => 'success',
            'message' => 'Citas obtenidas correctamente',
            'response' => true,
            'data' => $citas
        ]);
    }
    public static function insert($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para crear la cita',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['cita_fecha'],
            $_POST['cliente_id'],
            $_POST['user_id'],
            $_POST['hora_id'],
            $_POST['servicio_id']
        )) {
            $citaDao = new CitaDao($adapter);
            $cita_fecha = $_POST['cita_fecha'];
            $cliente_id = $_POST['cliente_id'];
            $user_id = $_POST['user_id'];
            $hora_id = $_POST['hora_id'];
            $servicio_id = $_POST['servicio_id'];
            $cita_id = $citaDao->insert(
                $cita_fecha,
                $cliente_id,
                $user_id,
                $hora_id,
                $servicio_id
            );
            if (!$cita_id) {
                $result['message'] = 'No se pudo crear la cita';
                echo json_encode($result);
                exit();
            }
            $result['status'] = 'success';
            $result['message'] = 'Cita creada correctamente';
            $result['response'] = true;
            $result['data'] = $cita_id;
        }
        echo json_encode($result);
    }
    public static function update($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para actualizar la cita',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['cita_id'],
            $_POST['cita_fecha'],
            $_POST['cliente_id'],
            $_POST['user_id'],
            $_POST['hora_id'],
            $_POST['servicio_id']
        )) {
            $citaDao = new CitaDao($adapter);
            $cita_id = $_POST['cita_id'];
            $cita_fecha = $_POST['cita_fecha'];
            $cliente_id = $_POST['cliente_id'];
            $user_id = $_POST['user_id'];
            $hora_id = $_POST['hora_id'];
            $servicio_id = $_POST['servicio_id'];
            $cita = $citaDao->selectById($cita_id);
            if (!$cita) {
                $result['message'] = 'La cita no existe';
                echo json_encode($result);
                exit();
            }
            $cita_id = $citaDao->update(
                $cita_id,
                $cita_fecha,
                $cliente_id,
                $user_id,
                $hora_id,
                $servicio_id
            );
            if (!$cita_id) {
                $result['message'] = 'No se pudo actualizar la cita';
                echo json_encode($result);
                exit();
            }
            $result['status'] = 'success';
            $result['message'] = 'Cita actualizada correctamente';
            $result['response'] = true;
            $result['data'] = $cita_id;
        }
        echo json_encode($result);
    }
    public static function delete($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para eliminar la cita',
            'response' => false,
            'data' => null
        ];
        if (isset($_POST['cita_id'])) {
            $citaDao = new CitaDao($adapter);
            $cita_id = $_POST['cita_id'];
            $resultset = $citaDao->deleteById($cita_id);
            if (!$resultset) {
                $result['message'] = 'No se pudo eliminar la cita';
                echo json_encode($result);
                exit();
            }
            $result['status'] = 'success';
            $result['message'] = 'Cita eliminada correctamente';
            $result['response'] = true;
            $result['data'] = $cita_id;
        }
        echo json_encode($result);
    }
}
