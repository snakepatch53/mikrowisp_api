<?php
// Online PHP compiler to run PHP program online
// Print "Hello World!" message
$urlapi = 'http://157.100.9.33:8015/admin/api.php';

//-->Datos a enviar
$postfields = array(
    'userapi' => 'tecnico', //--->* Usuario de acceso al sistema.
    'passwordapi' => md5('tecnico'), //--> * Contraseña Acceso al sistema.
    'comando' => 'RevisarCliente', //-->* Comando a ejecutar.
    'idcliente' => '000009' //--> ID del cliente (Ejm: 000001).
);

//-->LLamar a la API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlapi);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
$response = curl_exec($ch);
if (curl_error($ch)) {
    die('No puede conectarse:a ' . curl_errno($ch) . ' - ' . curl_error($ch));
}

curl_close($ch);

// decodificar la respuesta JSON
$jsonData = json_decode($response, true);
// Ver salida de datos
echo '<pre>';
print_r($jsonData);
echo '</pre>';
