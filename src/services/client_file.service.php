<?php
class ClientFileService
{
    public static function select($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $clientFileDao = new ClientFileDao($adapter);
        $client_files = $clientFileDao->select();
        echo json_encode([
            'status' => 'success',
            'message' => 'Archivos de clientes obtenidos correctamente',
            'response' => true,
            'data' => $client_files
        ]);
    }

    public static function insert($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para ingresar el archivo del cliente',
            'response' => false,
            'data' => null
        ];
        if (!isset(
            $_POST['client_file_name'],
            $_POST['client_file_desc'],
            $_FILES['client_file_stored'],
            $_POST['client_id']
        )) {
            echo json_encode($result);
            return;
        }

        $clientFileDao = new ClientFileDao($adapter);
        $client_file_name = $_POST['client_file_name'];
        $client_file_desc = $_POST['client_file_desc'];
        $client_file_stored = $_FILES['client_file_stored'];
        $client_id = $_POST['client_id'];

        if ($client_file_stored['tmp_name'] != "" or $client_file_stored['tmp_name'] != null) {
            $client_file_stored = uploadFIle($client_file_stored, './public/file.client_files/');
        }

        $client_file_id = $clientFileDao->insert(
            $client_file_name,
            $client_file_desc,
            $client_file_stored,
            $client_id
        );

        $result = [
            'status' => 'success',
            'message' => 'Archivo del cliente insertado correctamente',
            'response' => true,
            'data' => $client_file_id
        ];

        echo json_encode($result);
    }

    public static function update($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para actualizar el archivo del cliente',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['client_file_id'],
            $_POST['client_file_name'],
            $_POST['client_file_desc'],
            $_POST['client_id']
        )) {
            $clientFileDao = new ClientFileDao($adapter);

            $client_file_id = $_POST['client_file_id'];
            $current_client_file = $clientFileDao->selectById($client_file_id);

            if (!$current_client_file) {
                $result['message'] = 'El archivo del cliente no existe';
                echo json_encode($result);
                exit();
            }

            $clientFileDao = new ClientFileDao($adapter);
            $client_file_name = $_POST['client_file_name'];
            $client_file_desc = $_POST['client_file_desc'];
            $client_id = $_POST['client_id'];
            $client_file_stored = $current_client_file['client_file_stored'];

            if (isset($_FILES['client_file_stored'])) {
                if ($_FILES['client_file_stored']['tmp_name'] != "" or $_FILES['client_file_stored']['tmp_name'] != null) {
                    if ($client_file_stored != '') deleteFile('./public/file.client_files/' . $client_file_stored);
                    $client_file_stored = uploadFIle($_FILES['client_file_stored'], './public/file.client_files/');
                }
            }
            $client_file = $clientFileDao->update(
                $client_file_id,
                $client_file_name,
                $client_file_desc,
                $client_file_stored,
                $client_id
            );

            $result = [
                'status' => 'success',
                'message' => 'Archivo del cliente actualizado correctamente',
                'response' => true,
                'data' => $client_file
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
            'message' => 'Faltan datos para eliminar el archivo del cliente',
            'response' => false,
            'data' => null
        ];
        if (isset($_POST['client_file_id'])) {
            $clientFileDao = new clientFileDao($adapter);
            $client_file_id = $_POST['client_file_id'];
            $client_file = $clientFileDao->selectById($client_file_id);
            if (!$client_file) {
                $result['message'] = 'El archivo del cliente no existe';
                echo json_encode($result);
                exit();
            }
            if ($client_file['client_file_stored'] != '') {
                deleteFile('./public/file.client_files/' . $client_file['client_file_stored']);
            }

            $clientFileDao->deleteById($client_file_id);
            $result = [
                'status' => 'success',
                'message' => 'Archivo del cliente eliminado correctamente',
                'response' => true,
                'data' => null
            ];
        }
        echo json_encode($result);
    }
}
