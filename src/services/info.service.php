<?php
class InfoService
{
    public static function select($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $infoDao = new InfoDao($adapter);
        $info = $infoDao->select();
        $result = [
            'status' => 'success',
            'message' => 'Información obtenida correctamente',
            'response' => true,
            'data' => $info
        ];
        echo json_encode($result);
    }

    public static function update($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para actualizar la información',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['info_nombre'],
            $_POST['info_filosofia'],
            $_POST['info_resumen'],
            $_POST['info_mision'],
            $_POST['info_vision'],
            $_POST['info_mapa'],
            $_POST['info_direccion'],
            $_POST['info_ciudad'],
            $_POST['info_telefono'],
            $_POST['info_celular'],
            $_POST['info_email']
        )) {
            $adapter = $DATA['mysqlAdapter'];
            $infoDao = new InfoDao($adapter);
            $info_nombre = $_POST['info_nombre'];
            $info_filosofia = $_POST['info_filosofia'];
            $info_resumen = $_POST['info_resumen'];
            $info_mision = $_POST['info_mision'];
            $info_vision = $_POST['info_vision'];
            $info_mapa = $_POST['info_mapa'];
            $info_direccion = $_POST['info_direccion'];
            $info_ciudad = $_POST['info_ciudad'];
            $info_telefono = $_POST['info_telefono'];
            $info_celular = $_POST['info_celular'];
            $info_email = $_POST['info_email'];
            $resultset = $infoDao->update(
                $info_nombre,
                $info_filosofia,
                $info_resumen,
                $info_mision,
                $info_vision,
                $info_mapa,
                $info_direccion,
                $info_ciudad,
                $info_telefono,
                $info_celular,
                $info_email
            );
            if (!$resultset) {
                $result['message'] = 'Error al actualizar la información';
                echo json_encode($result);
                return;
            }
            if (isset($_FILES['info_logo1'])) uploadFIle($_FILES['info_logo1'], './public/img/', 'logo1', 'png');
            if (isset($_FILES['info_logo2'])) uploadFIle($_FILES['info_logo2'], './public/img/', 'logo2', 'png');
            if (isset($_FILES['info_logo3'])) uploadFIle($_FILES['info_logo3'], './public/img/', 'logo3', 'png');
            $result['status'] = 'success';
            $result['message'] = 'Información actualizada correctamente';
            $result['response'] = true;
        }
        echo json_encode($result);
    }
}
