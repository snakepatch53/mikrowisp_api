<?php
class ClienteService
{
    public static function select($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $clienteDao = new ClienteDao($adapter);
        $users = $clienteDao->select();
        $response = [
            'status' => 'success',
            'message' => 'Clientes obtenidos correctamente',
            'response' => true,
            'data' => $users
        ];
        echo json_encode($response);
    }
    public static function insert($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para ingresar el cliente',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['cliente_nombre'],
            $_POST['cliente_cedula'],
            $_POST['cliente_celular'],
            $_POST['cliente_email'],
            $_POST['cliente_direccion']
        )) {
            $clienteDao = new ClienteDao($adapter);

            $cliente_nombre = $_POST['cliente_nombre'];
            $cliente_cedula = $_POST['cliente_cedula'];
            $cliente_celular = $_POST['cliente_celular'];
            $cliente_email = $_POST['cliente_email'];
            $cliente_direccion = $_POST['cliente_direccion'];

            $user = $clienteDao->insert(
                $cliente_nombre,
                $cliente_cedula,
                $cliente_celular,
                $cliente_email,
                $cliente_direccion
            );
            $result['status'] = 'success';
            $result['message'] = 'Cliente insertado correctamente';
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
            $_POST['cliente_id'],
            $_POST['cliente_nombre'],
            $_POST['cliente_cedula'],
            $_POST['cliente_celular'],
            $_POST['cliente_email'],
            $_POST['cliente_direccion']
        )) {
            $clienteDao = new ClienteDao($adapter);
            $cliente_id = $_POST['cliente_id'];
            $cliente_nombre = $_POST['cliente_nombre'];
            $cliente_cedula = $_POST['cliente_cedula'];
            $cliente_celular = $_POST['cliente_celular'];
            $cliente_email = $_POST['cliente_email'];
            $cliente_direccion = $_POST['cliente_direccion'];

            $user = $clienteDao->update(
                $cliente_id,
                $cliente_nombre,
                $cliente_cedula,
                $cliente_celular,
                $cliente_email,
                $cliente_direccion
            );
            $result['status'] = 'success';
            $result['message'] = 'Cliente actualizado correctamente';
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
        if (isset($_POST['cliente_id'])) {
            $clienteDao = new ClienteDao($adapter);
            $cliente_id = $_POST['cliente_id'];
            $user = $clienteDao->deleteById($cliente_id);
            if ($user) {
                $result['status'] = 'success';
                $result['message'] = 'Cliente eliminado correctamente';
                $result['response'] = true;
                $result['data'] = $user;
            }
        }
        echo json_encode($result);
    }
}
