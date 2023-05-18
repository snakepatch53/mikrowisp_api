<?php
class HoraService
{
    public static function select($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $horaDao = new HoraDao($adapter);
        $horas = $horaDao->select();
        $result = [
            'status' => 'success',
            'message' => 'Horas obtenidas correctamente',
            'response' => true,
            'data' => $horas
        ];
        echo json_encode($result);
    }

    public static function insert($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para ingresar la hora',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['hora_hora']
        )) {
            $adapter = $DATA['mysqlAdapter'];
            $horaDao = new HoraDao($adapter);
            $hora_hora = $_POST['hora_hora'];
            $hora_id = $horaDao->insert(
                $hora_hora
            );
            $result['status'] = 'success';
            $result['message'] = 'Hora insertada correctamente';
            $result['response'] = true;
            $result['data'] = $hora_id;
        }
        echo json_encode($result);
    }

    public static function update($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para actualizar la hora',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['hora_id'],
            $_POST['hora_hora']
        )) {
            $adapter = $DATA['mysqlAdapter'];
            $horaDao = new HoraDao($adapter);
            $hora_id = $_POST['hora_id'];
            $hora_hora = $_POST['hora_hora'];
            $horaDao->update(
                $hora_id,
                $hora_hora
            );
            $result['status'] = 'success';
            $result['message'] = 'Hora actualizada correctamente';
            $result['response'] = true;
            $result['data'] = $hora_id;
        }
        echo json_encode($result);
    }

    public static function delete($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para eliminar la hora',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['hora_id']
        )) {
            $adapter = $DATA['mysqlAdapter'];
            $horaDao = new HoraDao($adapter);
            $hora_id = $_POST['hora_id'];
            $horaDao->delete($hora_id);
            $result['status'] = 'success';
            $result['message'] = 'Hora eliminada correctamente';
            $result['response'] = true;
            $result['data'] = $hora_id;
        }
        echo json_encode($result);
    }
}
