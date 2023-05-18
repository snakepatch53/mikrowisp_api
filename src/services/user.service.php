<?php
class UserService
{
    public static function login($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        if (isset(
            $_POST['user_user'],
            $_POST['user_pass']
        )) {
            $result = [
                'status' => 'error',
                'message' => 'Usuario o contraseña incorrectos',
                'response' => false,
                'data' => null
            ];
            $userDao = new UserDao($adapter);
            $username = $_POST['user_user'];
            $password = $_POST['user_pass'];
            $user = $userDao->login($username, $password);
            if ($user) {
                if ($user['user_user'] == $username and $user['user_pass'] == $password) {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_nombre'] = $user['user_nombre'];
                    $_SESSION['user_user'] = $user['user_user'];
                    $_SESSION['user_foto'] = $user['user_foto'];
                    $_SESSION['user_tipo'] = $user['user_tipo'];
                    $_SESSION['user_last'] = $user['user_last'];
                    $_SESSION['user_created'] = $user['user_created'];
                    $result['status'] = 'success';
                    $result['message'] = 'Bienvenido ' . $user['user_nombre'];
                    $result['response'] = true;
                    $result['data'] = $user;
                }
            }
            echo json_encode($result);
        }
    }
    public static function logout()
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        session_destroy();
        echo json_encode([
            'status' => 'success',
            'message' => 'Sesión cerrada',
            'response' => true,
            'data' => null
        ]);
        exit();
    }
    public static function select($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $userDao = new UserDao($adapter);
        $users = $userDao->select();
        echo json_encode([
            'status' => 'success',
            'message' => 'Usuarios obtenidos correctamente',
            'response' => true,
            'data' => $users
        ]);
    }
    public static function insert($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para ingresar el usuario',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['user_nombre'],
            $_POST['user_especialidad'],
            $_POST['user_user'],
            $_POST['user_pass'],
            $_POST['user_tipo']
        )) {
            $userDao = new UserDao($adapter);
            $user_nombre = $_POST['user_nombre'];
            $user_especialidad = $_POST['user_especialidad'];
            $user_user = $_POST['user_user'];
            $user_pass = $_POST['user_pass'];
            $user_tipo = $_POST['user_tipo'];
            $user_foto = "default.png";
            if (isset($_FILES['user_foto'])) {
                if ($_FILES['user_foto']['tmp_name'] != "" or $_FILES['user_foto']['tmp_name'] != null) {
                    $user_foto = uploadFIle($_FILES['user_foto'], './public/img.users/');
                }
            };
            $user = $userDao->insert(
                $user_nombre,
                $user_especialidad,
                $user_user,
                $user_pass,
                $user_foto,
                $user_tipo
            );
            $result['status'] = 'success';
            $result['message'] = 'Usuario insertado correctamente';
            $result['response'] = true;
            $result['data'] = $user;
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
            'message' => 'Faltan datos para actualizar el usuario',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['user_id'],
            $_POST['user_nombre'],
            $_POST['user_especialidad'],
            $_POST['user_user'],
            $_POST['user_pass'],
            $_POST['user_tipo']
        )) {
            $userDao = new UserDao($adapter);

            $user_id = $_POST['user_id'];
            $current_user = $userDao->selectById($user_id);
            if (!$current_user) {
                $result['message'] = 'El usuario no existe';
                echo json_encode($result);
                exit();
            }

            $user_nombre = $_POST['user_nombre'];
            $user_especialidad = $_POST['user_especialidad'];
            $user_user = $_POST['user_user'];
            $user_pass = $_POST['user_pass'];
            $user_tipo = $_POST['user_tipo'];
            $user_foto = $current_user['user_foto'];

            if (isset($_FILES['user_foto'])) {
                if ($_FILES['user_foto']['tmp_name'] != "" or $_FILES['user_foto']['tmp_name'] != null) {
                    if ($user_foto != 'default.png' && $user_foto != '1.png' && $user_foto != '2.png' && $user_foto != '') deleteFile('./public/img.users/' . $user_foto);
                    $user_foto = uploadFIle($_FILES['user_foto'], './public/img.users/');
                }
            }
            $user = $userDao->update(
                $user_id,
                $user_nombre,
                $user_especialidad,
                $user_user,
                $user_pass,
                $user_foto,
                $user_tipo
            );
            $result['status'] = 'success';
            $result['message'] = 'Usuario actualizado correctamente';
            $result['response'] = true;
            $result['data'] = $user;
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
            'message' => 'Faltan datos para eliminar el usuario',
            'response' => false,
            'data' => null
        ];
        if (isset($_POST['user_id'])) {
            $userDao = new UserDao($adapter);
            $user_id = $_POST['user_id'];
            $user = $userDao->selectById($user_id);
            if (!$user) {
                $result['message'] = 'El usuario no existe';
                echo json_encode($result);
                exit();
            }
            if ($user['user_foto'] != 'default.png' && $user['user_foto'] != '1.png' && $user['user_foto'] != '2.png' && $user['user_foto'] != '') {
                deleteFile('./public/img.users/' . $user['user_foto']);
            }
            $userDao->deleteById($user_id);
            $result['status'] = 'success';
            $result['message'] = 'Usuario eliminado correctamente';
            $result['response'] = true;
        }
        echo json_encode($result);
    }
}
