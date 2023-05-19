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
                    $_SESSION['user_name'] = $user['user_name'];
                    $_SESSION['user_user'] = $user['user_user'];
                    $_SESSION['user_photo'] = $user['user_photo'];
                    $_SESSION['user_photo_url'] = $user['user_photo_url'];
                    $_SESSION['user_last'] = $user['user_last'];
                    $_SESSION['user_created'] = $user['user_created'];
                    $result = [
                        'status' => 'success',
                        'message' => 'Bienvenido ' . $user['user_name'],
                        'response' => true,
                        'data' => $user
                    ];
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
            $_POST['user_name'],
            $_POST['user_user'],
            $_POST['user_pass'],
        )) {
            $userDao = new UserDao($adapter);
            $user_name = $_POST['user_name'];
            $user_user = $_POST['user_user'];
            $user_pass = $_POST['user_pass'];
            $user_photo = "default.png";
            if (isset($_FILES['user_photo'])) {
                if ($_FILES['user_photo']['tmp_name'] != "" or $_FILES['user_photo']['tmp_name'] != null) {
                    $user_photo = uploadFIle($_FILES['user_photo'], './public/img.users/');
                }
            };

            $user = $userDao->insert(
                $user_name,
                $user_user,
                $user_pass,
                $user_photo
            );

            $result = [
                'status' => 'success',
                'message' => 'Usuario ingresado correctamente',
                'response' => true,
                'data' => $user
            ];
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
            $_POST['user_name'],
            $_POST['user_user'],
            $_POST['user_pass']
        )) {
            $userDao = new UserDao($adapter);

            $user_id = $_POST['user_id'];
            $current_user = $userDao->selectById($user_id);
            if (!$current_user) {
                $result['message'] = 'El usuario no existe';
                echo json_encode($result);
                exit();
            }

            $user_name = $_POST['user_name'];
            $user_user = $_POST['user_user'];
            $user_pass = $_POST['user_pass'];
            $user_photo = $current_user['user_photo'];

            if (isset($_FILES['user_photo'])) {
                if ($_FILES['user_photo']['tmp_name'] != "" or $_FILES['user_photo']['tmp_name'] != null) {
                    if ($user_photo != 'default.png' && $user_photo != '') deleteFile('./public/img.users/' . $user_photo);
                    $user_photo = uploadFIle($_FILES['user_photo'], './public/img.users/');
                }
            }
            $user = $userDao->update(
                $user_id,
                $user_name,
                $user_user,
                $user_pass,
                $user_photo
            );
            $result = [
                'status' => 'success',
                'message' => 'Usuario actualizado correctamente',
                'response' => true,
                'data' => $user
            ];
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
            if ($user['user_photo'] != 'default.png' && $user['user_photo'] != '') {
                deleteFile('./public/img.users/' . $user['user_photo']);
            }

            $userDao->deleteById($user_id);
            $result = [
                'status' => 'success',
                'message' => 'Usuario eliminado correctamente',
                'response' => true,
                'data' => null
            ];
        }
        echo json_encode($result);
    }
}
