<?php
class ClientService
{
    public static function select($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $clientDao = new ClientDao($adapter);
        $clients = $clientDao->select();
        echo json_encode([
            'status' => 'success',
            'message' => 'Clientes obtenidos correctamente',
            'response' => true,
            'data' => $clients
        ]);
    }

    public static function selectByDni($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $mysqlAdapter = $DATA['mysqlAdapter'];
        $clientDao = new ClientDao($mysqlAdapter);
        $apiAdapter = new ApiAdapter((new InfoDao($mysqlAdapter))->getAPI());
        $clientApi = new ClientApi($apiAdapter);
        if (empty($_POST['client_mkw_dni'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Faltan datos para obtener el cliente',
                'response' => false,
                'data' => null
            ]);
            return;
        }

        $client_mkw_dni = $_POST['client_mkw_dni'];
        $client_db = $clientDao->selectByMkwDni($client_mkw_dni);
        $client_mkw = $clientApi->selectByDni($client_mkw_dni);

        if (!$client_mkw) {
            echo json_encode([
                'status' => 'error',
                'message' => 'El cliente no existe en mikrowisp',
                'response' => false,
                'data' => null
            ]);
            return;
        }

        if (!$client_db) {
            $clientDao->insert(
                $client_mkw['nombre'],
                $client_mkw['id'],
                $client_mkw['cedula']
            );

            $client_db = $clientDao->selectByMkwDni($client_mkw_dni);
        } else {
            $clientDao->update(
                $client_db['client_id'],
                $client_mkw['nombre'],
                $client_mkw['id'],
                $client_mkw['cedula']
            );
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Cliente obtenido correctamente',
            'response' => true,
            'data' => array_merge($client_db, $client_mkw)
        ]);
    }

    public static function insert($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $mysqlAdapter = $DATA['mysqlAdapter'];
        $clientDao = new ClientDao($mysqlAdapter);
        $apiAdapter = new ApiAdapter((new InfoDao($mysqlAdapter))->getAPI());
        $clientApi = new ClientApi($apiAdapter);
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para ingresar el cliente',
            'response' => false,
            'data' => null
        ];

        if (empty($_POST['client_mkw_dni'])) {
            echo json_encode($result);
            return;
        }

        $client_mkw_dni = $_POST['client_mkw_dni'];
        $client = $clientApi->selectByDni($client_mkw_dni);

        if (!$client) {
            $result['message'] = 'El cliente no existe en mikrowisp';
            echo json_encode($result);
            exit();
        }

        $client_name = $client['nombre'];
        $client_mkw_id = $client['id'];

        $client = $clientDao->insert(
            $client_name,
            $client_mkw_id,
            $client_mkw_dni
        );

        $result['status'] = 'success';
        $result['message'] = 'Cliente insertado correctamente';
        $result['response'] = true;
        $result['data'] = $client;
        echo json_encode($result);
    }

    public static function update($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $mysqlAdapter = $DATA['mysqlAdapter'];
        $clientDao = new ClientDao($mysqlAdapter);
        $apiAdapter = new ApiAdapter((new InfoDao($mysqlAdapter))->getAPI());
        $clientApi = new ClientApi($apiAdapter);
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para actualizar el cliente',
            'response' => false,
            'data' => null
        ];

        if (empty($_POST['client_mkw_dni'])) {
            echo json_encode($result);
            return;
        }

        $client_mkw_dni = $_POST['client_mkw_dni'];
        $current_client = $clientDao->selectByMkwDni($client_mkw_dni);

        if (!$current_client) {
            $result['message'] = 'El cliente no existe';
            echo json_encode($result);
            exit();
        }

        $currernt_mkw_client = $clientApi->selectById($current_client['client_mkw_id']);

        if (!$currernt_mkw_client) {
            $result['message'] = 'El cliente no existe en mikrowisp';
            echo json_encode($result);
            exit();
        }

        $cliente_id = $current_client['client_id'];

        $client = $clientDao->update(
            $cliente_id,
            $currernt_mkw_client['nombre'],
            $currernt_mkw_client['id'],
            $currernt_mkw_client['cedula']
        );

        $result['status'] = 'success';
        $result['message'] = 'Cliente actualizado correctamente';
        $result['response'] = true;
        $result['data'] = $client;

        echo json_encode($result);
    }

    public static function delete($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $mysqlAdapter = $DATA['mysqlAdapter'];
        $clientDao = new ClientDao($mysqlAdapter);
        $apiAdapter = new ApiAdapter((new InfoDao($mysqlAdapter))->getAPI());
        $clientApi = new ClientApi($apiAdapter);
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para eliminar el Cliente',
            'response' => false,
            'data' => null
        ];

        if (empty($_POST['client_mkw_dni'])) {
            echo json_encode($result);
            return;
        }

        $client_mkw_dni = $_POST['client_mkw_dni'];
        $client = $clientDao->selectByMkwDni($client_mkw_dni);
        if (!$client) {
            $result['message'] = 'El cliente no existe';
            echo json_encode($result);
            exit();
        }

        $current_mkw_client = $clientApi->selectById($client['client_mkw_id']);

        if ($current_mkw_client) {
            $result['message'] = 'El cliente no se puede eliminar porque existe en mikrowisp';
            echo json_encode($result);
            exit();
        }

        $clientDao->deleteByMkwDni($client_mkw_dni);
        $result['status'] = 'success';
        $result['message'] = 'Cliente eliminado correctamente';
        $result['response'] = true;
        echo json_encode($result);
    }
}
