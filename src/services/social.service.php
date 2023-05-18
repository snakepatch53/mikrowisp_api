<?php
class SocialService
{
    public static function select($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $socialDao = new SocialDao($adapter);
        $socials = $socialDao->select();
        $result = [
            'status' => 'success',
            'message' => 'Redes sociales obtenidas correctamente',
            'response' => true,
            'data' => $socials
        ];
        echo json_encode($result);
    }

    public static function insert($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para ingresar la red social',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['social_nombre'],
            $_POST['social_url'],
            $_POST['social_icon'],
            $_POST['social_color']
        )) {
            $adapter = $DATA['mysqlAdapter'];
            $socialDao = new SocialDao($adapter);
            $social_nombre = $_POST['social_nombre'];
            $social_url = $_POST['social_url'];
            $social_icon = $_POST['social_icon'];
            $social_color = $_POST['social_color'];
            $social_id = $socialDao->insert(
                $social_nombre,
                $social_url,
                $social_icon,
                $social_color
            );
            $result['status'] = 'success';
            $result['message'] = 'Red social insertada correctamente';
            $result['response'] = true;
            $result['data'] = $social_id;
        }
        echo json_encode($result);
    }

    public static function update($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para actualizar la red social',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['social_id'],
            $_POST['social_nombre'],
            $_POST['social_url'],
            $_POST['social_icon'],
            $_POST['social_color']
        )) {
            $adapter = $DATA['mysqlAdapter'];
            $socialDao = new SocialDao($adapter);
            $social_id = $_POST['social_id'];
            $social_nombre = $_POST['social_nombre'];
            $social_url = $_POST['social_url'];
            $social_icon = $_POST['social_icon'];
            $social_color = $_POST['social_color'];
            $socialDao->update(
                $social_id,
                $social_nombre,
                $social_url,
                $social_icon,
                $social_color
            );
            $result['status'] = 'success';
            $result['message'] = 'Red social actualizada correctamente';
            $result['response'] = true;
            $result['data'] = $social_id;
        }
        echo json_encode($result);
    }

    public static function delete($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para eliminar la red social',
            'response' => false,
            'data' => null
        ];
        if (isset($_POST['social_id'])) {
            $adapter = $DATA['mysqlAdapter'];
            $socialDao = new SocialDao($adapter);
            $social_id = $_POST['social_id'];
            $socialDao->delete($social_id);
            $result['status'] = 'success';
            $result['message'] = 'Red social eliminada correctamente';
            $result['response'] = true;
            $result['data'] = $social_id;
        }
        echo json_encode($result);
    }
}
