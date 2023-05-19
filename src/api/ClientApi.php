<?php
class ClientApi
{
    // LISTA DE COMANDOS
    const COMANDO_GET_CLIENTS_DETAILS = 'GetClientsDetails';

    private ApiAdapter $apiAdapter;
    public function __construct(ApiAdapter $apiAdapter)
    {
        $this->apiAdapter = $apiAdapter;
    }

    public function selectById(string $client_id)
    {
        $result = ($this->apiAdapter)->request('POST', self::COMANDO_GET_CLIENTS_DETAILS, [
            "idcliente" => $client_id
        ]);

        if (!$result) return false;
        return $result['datos'][0];
    }

    public function selectByDni(string $dni)
    {
        $result = ($this->apiAdapter)->request('POST', self::COMANDO_GET_CLIENTS_DETAILS, [
            "cedula" => $dni
        ]);

        if (!$result) return false;
        return $result['datos'][0];
    }
}
