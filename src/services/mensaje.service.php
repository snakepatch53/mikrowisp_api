<?php
class MensajeService
{

    public static function select($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $mensajeDao = new MensajeDao($adapter);
        $mensajes = $mensajeDao->select();
        echo json_encode([
            'status' => 'success',
            'message' => 'Mensajes encontrados',
            'response' => true,
            'data' => $mensajes
        ]);
    }
    public static function insert($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para ingresar el mensaje',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['mensaje_nombre'],
            $_POST['mensaje_celular'],
            $_POST['mensaje_email'],
            $_POST['mensaje_mensaje']
        )) {
            $mensajeDao = new MensajeDao($adapter);
            $mensaje_nombre = $_POST['mensaje_nombre'];
            $mensaje_celular = $_POST['mensaje_celular'];
            $mensaje_email = $_POST['mensaje_email'];
            $mensaje_mensaje = $_POST['mensaje_mensaje'];
            $mensaje = $mensajeDao->insert(
                $mensaje_nombre,
                $mensaje_celular,
                $mensaje_email,
                $mensaje_mensaje
            );
            $result['status'] = 'success';
            $result['message'] = 'Mensaje ingresado correctamente';
            $result['response'] = true;
            $result['data'] = $mensaje;
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
            'message' => 'Faltan datos para actualizar el mensaje',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['mensaje_id'],
            $_POST['mensaje_nombre'],
            $_POST['mensaje_celular'],
            $_POST['mensaje_email'],
            $_POST['mensaje_mensaje']
        )) {
            $mensajeDao = new MensajeDao($adapter);
            $mensaje_id = $_POST['mensaje_id'];
            $mensaje_nombre = $_POST['mensaje_nombre'];
            $mensaje_celular = $_POST['mensaje_celular'];
            $mensaje_email = $_POST['mensaje_email'];
            $mensaje_mensaje = $_POST['mensaje_mensaje'];
            $mensaje = $mensajeDao->selectById($mensaje_id);
            if (!$mensaje) {
                $result['message'] = 'El mensaje no existe';
                echo json_encode($result);
                exit();
            }
            $mensaje = $mensajeDao->update(
                $mensaje_id,
                $mensaje_nombre,
                $mensaje_celular,
                $mensaje_email,
                $mensaje_mensaje
            );
            $result['status'] = 'success';
            $result['message'] = 'Mensaje actualizado correctamente';
            $result['response'] = true;
            $result['data'] = $mensaje;
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
            'message' => 'Faltan datos para eliminar el mensaje',
            'response' => false,
            'data' => null
        ];
        if (isset($_POST['mensaje_id'])) {
            $mensajeDao = new MensajeDao($adapter);
            $mensaje_id = $_POST['mensaje_id'];
            $mensaje = $mensajeDao->selectById($mensaje_id);
            if (!$mensaje) {
                $result['message'] = 'El mensaje no existe';
                echo json_encode($result);
                exit();
            }
            $mensaje = $mensajeDao->deleteById($mensaje_id);
            $result['status'] = 'success';
            $result['message'] = 'Mensaje eliminado correctamente';
            $result['response'] = true;
            $result['data'] = $mensaje;
        }
        echo json_encode($result);
    }
}
